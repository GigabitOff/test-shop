<?php

namespace App\Services;

use App\Models\Counterparty;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ReconciliationService
{

    public static function uploadFrom1C(Counterparty $counterparty, User $user)
    {
        $settings = Setting::query()
            ->where('category', 'api-settings')
            ->get();
        $url = $settings->firstWhere('key', 'getdebitdata_url')->value ?? '';
        $authorization = $settings->firstWhere('key', 'getdebitdata_authorization')->value ?? '';

        $payload = [
            'user_id_1c' => $user->id_1c,
            'counterparty_id_1c' => $counterparty->id_1c,
            'date_start' => now()->startOfMonth()->format('Ymd'),
            'date_end' => now()->endOfMonth()->format('Ymd'),
        ];

        $dir = "counterparty/{$counterparty->id}/debit";
        // подчищаем старые файлы
//            File::cleanDirectory(Storage::disk('public')->path($dir));

        $headers = $authorization
            ? ['Authorization' => "$authorization"]
            : [];

//            $url = 'http://tm.fairtech.local/getbalance';
        $rawResponse = Http::withHeaders($headers)->get($url, $payload)->throw();

        // Удаляем bom байты
        $body = preg_replace('/^([^\{]+)/', '', $rawResponse->body());

        $response = json_decode($body);

        if ($response) {
            if ('success' === $response->status) {
                $content = $response->content;
                $model = $counterparty->reconciliations()
                    ->where('id_1c', $content->id_1c)
                    ->firstOrNew();

                $model->fill([
                    'id_1c' => $content->id_1c,
                    'registry_no' => $content->registry_no,
                    'counterparty_id' => $counterparty->id,
                    'date' => (new Carbon($content->date)) ?? now(),
                    'debit' => $content->debit,
                    'credit' => $content->credit,
                    'overdue' => $content->overdue,
                    'signed' => (bool)$content->signed,
                ]);


                $filename = $response->content->file_name;
                $newFilename = preg_replace('/\.([^\.]+)$/', '_' . now()->timestamp . '.$1', $filename);
                $filePath = "{$dir}/{$newFilename}";
                $fileContent = base64_decode($response->content->file_content);

                Storage::disk('public')->put($filePath, $fileContent);

                Storage::disk('public')->delete($model->uri);

                $model->uri = $filePath;
                $model->filename = $content->file_name;

                $model->save();

                return $model;
            } else {
                return false;
            }
        } else {
            throw(new \Exception('Response error for: ' . json_encode($payload)));
        }
    }

}
