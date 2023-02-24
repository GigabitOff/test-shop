<?php

namespace App\DTO\ChatMessage;

use Illuminate\Support\Facades\Storage;

class Vacancy
{
    public string $type = 'vacancy';
    public string $vacancy = '';
    public string $fio = '';
    public string $phone = '';
    public string $email = '';
    public string $text = '';
    public string $file = '';

    public static function from(array $data): Vacancy
    {
        $me = new Vacancy();
        $me->vacancy = $data['vacancy'] ?? '';
        $me->fio = $data['fio'] ?? '';
        $me->phone = $data['phone'] ?? '';
        $me->email = $data['email'] ?? '';
        $me->text = $data['text'] ?? '';
        $me->file = $data['file'] ?? '';

        return $me;
    }

    public function toString(): string
    {
        return json_encode([
            'type' => $this->type,
            'vacancy' => $this->vacancy,
            'fio' => $this->fio,
            'phone' => $this->phone,
            'email' => $this->email,
            'text' => $this->text,
            'file' => $this->file,
        ]);
    }

    public function formatOneLine(): string
    {
        return "{$this->fio} // {$this->phone} // {$this->email}";
    }

    public function formatMultiLine(): string
    {
        return ($this->vacancy ? __('custom::site.vacancy') . ": {$this->vacancy} <br> " : '')
            . __('custom::site.fio') . ": {$this->fio} <br> "
            . __('custom::site.phone') . ": {$this->phone} <br> "
            . __('custom::site.Email') . ": {$this->email} <br> "
            . __('custom::site.accompanying_text') . ": {$this->text} <br> "
            . $this->makeFileLink();
    }

    protected function makeFileLink(): string
    {
        if ($this->file && Storage::disk('public')->exists($this->file)){
            $url = Storage::disk('public')->url($this->file);
            return sprintf(
                '%s: <a href="%s" target="_blank">%s</a>',
                __('custom::site.file'),
                $url,
                __('custom::site.resume')
            );
        }

        return '';
    }
}
