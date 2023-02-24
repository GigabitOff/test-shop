<?php

namespace App\Http\Livewire\Forms;

use App\Models\Document;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use ZanySoft\Zip\Zip;

class ActComplaintDownloadLivewire extends Component
{
    public ?Order $order = null;

    public bool $isUploadLazyContent = false;

    public function render()
    {
        $records = $this->isUploadLazyContent
            ? $this->revalidateComplaints()
            : [];

        return view(
            'livewire.forms.act-complaint-download-livewire',
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

    protected function revalidateComplaints()
    {
        return $this->order->documentComplaints()
            ->with(['products.images', 'products.categories'])
            ->get()
            ->each(function(Document $document){
                $document->totalQuantity = $document->products->sum('pivot.quantity');
                $document->totalCost = $document->products->sum('pivot.total_nds');
            });
    }

    public function downloadAll()
    {
        $files = $this->order->documentComplaints
            ->map(function(Document $document){
                return Storage::disk('public')->path($document->path);
            })
            ->filter()
            ->toArray();

        if ($files) {
            $zip = Zip::create(Storage::disk('public')->path('complaints.zip'));
            $zip->add($files);
            $zip->close();

            return response()->download(Storage::disk('public')->path('complaints.zip'));
        } else {
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.complaint_acts'),
                'message' => __('custom::site.no_files_to_download'),
                'state' => 'danger'
            ]);
        }
    }
}
