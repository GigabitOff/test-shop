<?php

namespace App\Http\Livewire\Forms;

use App\Models\Document;
use App\Services\DocumentsService;
use Livewire\Component;
use Livewire\WithFileUploads;

class ActReverseLivewire extends Component
{
    use WithFileUploads;

    public string $message = '';
    public $uploaded = [];
    public $photos;

    public array $rules = [
        'message' => 'required',
    ];

    protected $listeners = [
        'eventSaveDocumentImages'
    ];

    public function updatedPhotos($value)
    {
        $this->validate([
            'photos.*' => 'image|max:1024', // 1MB Max
        ]);

        foreach ($this->photos as $file) {
            $this->uploaded[] = $file;
        }
    }

    public function sendForm()
    {
        $this->validate();

        $this->emit('eventCreateReverseInvoice', $this->message);
    }

    public function render()
    {
        return view('livewire.forms.act-reverse-livewire');
    }

    public function resetForm()
    {
        $this->reset(['message','uploaded','photos']);
        $this->clearValidation();
    }

    public function validationAttributes(): array
    {
        return [
            'photos.*' => __('custom::site.add_photo'),
            'message' => __('custom::site.message'),
        ];
    }

    public function removePhoto($index)
    {
        unset($this->uploaded[(int)$index]);
    }

    public function eventSaveDocumentImages($documentId)
    {
        $documentId = (int)$documentId;

        if ($document = Document::find($documentId)){
            foreach ($this->uploaded as $file) {
                app(DocumentsService::class)
                    ->saveUploadedImage($document, $file, $file->getClientOriginalName());
            }
        }

        $this->dispatchBrowserEvent('flashMessage', [
            'title' => __('custom::site.returning'),
            'message' => __('custom::site.info_messages.thank_application_submitted_for_consideration'),
            'state' => 'success'
        ]);

        $this->resetForm();
    }
}
