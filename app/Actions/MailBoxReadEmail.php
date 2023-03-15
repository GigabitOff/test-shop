<?php

namespace App\Actions;

use App\Models\MailboxEmail;
use App\Models\User;
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
        $client = Client::account('default');
        $client->connect();

        $folder = $client->getFolder('INBOX');
        $messages = $folder->messages()->unseen()->get();
        foreach ($messages as $message) {
            if ($customer = $this->extractRecipient($message)) {
                $customer->mailboxEmails()->updateOrCreate(
                    [
                        'uid' => $message->getUid(),
                    ],
                    [
                        'body' => $this->cleanHtmlBody($message->getHtmlBody()),
                        'inout' => MailboxEmail::DIRECTION_IN,
                        'dispatch_at' => $message->getDate()
                    ]
                );
            }

            $message->setFlag('seen');  // установка флага, что письмо прочитано
        }
    }

    /**
     * Определяем получателя по заголовку письма.
     * В заголовке должен быть шаблон #{id}#
     *
     * @param $message
     * @return User|null
     */
    protected function extractRecipient($message): ?User
    {
        $subject = (string)$message->getSubject();
        if (preg_match('/#([\d]+)#/', $subject, $matches)) {
            return User::find((int)($matches[1] ?? 0));
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
