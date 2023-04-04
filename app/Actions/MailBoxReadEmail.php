<?php

namespace App\Actions;

use App\Models\MailboxEmail;
use App\Models\User;
use App\Models\Chat;
use Webklex\IMAP\Facades\Client;
use App\Mail\SendFromChatMail;
use Illuminate\Support\Facades\Mail;

/**
 * @url Help - https://www.php-imap.com/
 */
class MailBoxReadEmail
{
    /**
     * Читает сообщения входящей почты и сохраняет их в БД
     * @return void
     * @throws \Webklex\PHPIMAP\Exceptions\ConnectionFailedException
     * @throws \Webklex\PHPIMAP\Exceptions\FolderFetchingException
     * @throws \Webklex\PHPIMAP\Exceptions\RuntimeException
     */
    public function __invoke()
    {
        //Обработка входящей почты
        try {

        $client = Client::account('default');
        $client->connect();

        $folder = $client->getFolder('INBOX');
        $messages = $folder->messages()->unseen()->get();
        //dd($messages);

            //code...

        foreach ($messages as $message) {

            if ($chat = $this->extractRecipient($message)) {
                    $res_save = null;
                //dd($chat);
               /* $customer->mailboxEmails()->updateOrCreate(
                    [
                        'uid' => $message->getUid(),
                    ],
                    [
                        'body' => $this->cleanHtmlBody($message->getHtmlBody()),
                        'inout' => MailboxEmail::DIRECTION_IN,
                        'dispatch_at' => $message->getDate()
                    ]
                );
                */

                $forSaveMessage = $message->getHtmlBody();

                    //$messages = $forSaveMessage->getLast();
                    // $forSaveMessage = end($messages);


                if ($chat AND $chat->closed == 0) {
                    $owner_id = $chat->customer_id;
                    $res_save = $chat->messages()->create([
                        'owner_id' => $owner_id,
                        'manager_id' =>  null,
                        'message' => $this->cleanHtmlBody($forSaveMessage),
                    ]);

                   // $chat['message_email'] = $forSaveMessage;

                    //$this->sendMailMeneger($chat, $forSaveMessage);
                }else{
                        $data['error'] = true;
                    if(isset($chat->email)){
                        $data['subject'] = $chat->subject;
                        $data['userId'] = $chat->id;
                        $res = Mail::to($chat->email)->send(new SendFromChatMail($data));
                    }

                }

                logger(__METHOD__ .(is_object($res_save) ? $res_save->id . 'Збережено в бд: ID: ' : 'не збережено в бд'));

                $message->setFlag('seen');  // установка флага, что письмо прочитано


            }else{

                $chat = Chat::find($message->getUid());

                if($chat)
                {
                   $owner_id = $chat->customer_id;
                    $chat->messages()->create([
                    'owner_id' => $owner_id,
                    'manager_id' =>  null,
                    'message' => $this->cleanHtmlBody($message->getHtmlBody()),
                ]);
                }

            }



        }
        } catch (\Throwable $th) {
            logger(__METHOD__ . $th->getMessage());

        }
    }

    /**
     * Определяем получателя по заголовку письма.
     * В заголовке должен быть шаблон #{id}#
     *
     * @param $message
     * @return User|null
     */
    protected function extractRecipient($message): ?Chat
    {
        $subject = (string)$message->getSubject();
        if (preg_match('/#([\d]+)#/', $subject, $matches)) {
            //dd($matches[1]);
            return Chat::find((int)($matches[1] ?? 0));
        }

        return null;
    }

    protected function sendMailMeneger($data,$message_email=''){

        try {

            $data['message'] = $message_email;
            //$data['popup'] = @$this->chat->popup->name;
            $data['name'] = @$data->customer->id;
            $data['subject'] = 'Відповідь на лист: ' . $data->subject;


            if ($data->manager)
                $email = $data->manager->email;

            if (isset($email))
                $res = Mail::to($email)->send(new SendFromChatMail($data));
        } catch (\Throwable $th) {
            logger(__METHOD__ . $th->getMessage());
            //throw $th;
        }

    }


    protected function cleanHtmlBody($html): string
    {
        // Добавляем пробел перед каждым тегом

        $html_tmp = explode('From', $html)[0];
        $html_tmp = explode('<br>', $html_tmp)[0];
        $html = str_replace('<', ' <', $html_tmp);

        // Очищаем сообшение от цитат (копий исходного) и html тегов.
        $text = strip_tags(preg_replace('/<blockquote(.*)<\/blockquote>/ms', '', $html));

        // Заменяем 4-х байтовые символы символом U+FFFD (не удаляем, что бы избежать XSS)
        $text = preg_replace('/[\x{10000}-\x{10FFFF}]/u', "\xEF\xBF\xBD", $text);
        $text = str_replace('&nbsp;', "", $text);
        $text = preg_replace('/\s{2,}/', ' ', $text);
        // Удаляем лишние пробелы
        return $text;
    }
}
