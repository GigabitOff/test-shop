<?php

namespace App\DTO\ChatMessage;

class AskQuestion
{
    public string $type = 'ascQuestion';
    public string $fio = '';
    public string $phone = '';
    public string $text = '';
    public string $url = '';

    public static function from(array $data): AskQuestion
    {
        $me = new AskQuestion();
        $me->fio = $data['fio'] ?? '';
        $me->phone = $data['phone'] ?? '';
        $me->text = $data['text'] ?? '';
        $me->url = $data['url'] ?? '';

        return $me;
    }

    public function toString(): string
    {
        return json_encode([
            'type' => $this->type,
            'fio' => $this->fio,
            'phone' => $this->phone,
            'text' => $this->text,
            'url' => $this->url,
        ]);
    }

    public function formatOneLine(): string
    {
        return "{$this->fio} // {$this->phone}";
    }

    public function formatMultiLine(): string
    {
        return
              __('custom::site.fio') . ": {$this->fio} <br> "
            . __('custom::site.phone') . ": {$this->phone} <br> "
            . __('custom::site.message') . ": {$this->text} <br> "
            . $this->makeLink();
    }

    protected function makeLink(): string
    {
        if ($this->url){
            return sprintf(
                '%s: <a href="%s" target="_blank">%s</a>',
                __('custom::site.Product link'),
                $this->url,
                __('custom::site.review')
            );
        }

        return '';
    }
}
