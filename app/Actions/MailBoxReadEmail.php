<?php

namespace App\Actions;

use App\Models\MailboxEmail;
use App\Models\User;
use App\Models\Chat;
use Webklex\IMAP\Facades\Client;

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


                if ($chat) {
                    $owner_id = $chat->customer_id;
                    $chat->messages()->create([
                        'owner_id' => $owner_id,
                        'manager_id' =>  null,
                        'message' => $this->cleanHtmlBody($message->getHtmlBody()),
                    ]);
                }


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

            $message->setFlag('seen');  // установка флага, что письмо прочитано


        }
        } catch (\Throwable $th) {

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

    protected function cleanHtmlBody($html): string
    {
        // Добавляем пробел перед каждым тегом
        $html = str_replace('<', ' <', $html);

        // Очищаем сообшение от цитат (копий исходного) и html тегов.
        $text = strip_tags(preg_replace('/<blockquote(.*)<\/blockquote>/ms', '', $html));

        // Заменяем 4-х байтовые символы символом U+FFFD (не удаляем, что бы избежать XSS)
        $text = preg_replace('/[\x{10000}-\x{10FFFF}]/u', "\xEF\xBF\xBD", $text);

        // Удаляем лишние пробелы
        return preg_replace('/\s{2,}/', ' ', $text);
    }
}
