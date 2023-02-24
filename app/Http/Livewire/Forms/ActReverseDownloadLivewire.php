<?php

namespace App\Http\Livewire\Forms;

use App\Models\Document;
use App\Models\Order;
use App\Services\DocumentsService;
use Livewire\Component;
use Livewire\WithFileUploads;

class ActReverseDownloadLivewire extends Component
{
    public bool $isUploadLazyContent = false;

    protected ?Order $order = null;

    public function render()
    {
        $records = $this->isUploadLazyContent
            ? $this->revalidateReverses()
            : [];

        return view('livewire.forms.act-reverse-download-livewire',
            compact('records')
        );
    }

    public function uploadLazyContent($payload = null)
    {
        $this->order = isset($payload['order_id']) ? Order::find((int)$payload['order_id']) : null;

        if (!$this->order) {
            return;
        }

        $this->isUploadLazyContent = true;
    }

    protected function revalidateReverses()
    {
        return $this->order->documentReverses()
            ->whereNotNull('filename')
            ->whereNotNull('path')
            ->get();
    }

}
