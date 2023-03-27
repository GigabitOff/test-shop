<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangedProductPrices extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $categories;
    public $socials;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $categories)
    {
        $this->user = $user;
        $this->categories = $categories;
        $this->socials = Setting::where('category', 'social')->where('value', '<>', '')->get();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.changed-product-prices');
    }
}
