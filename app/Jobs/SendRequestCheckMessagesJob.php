<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\ChatMessage;

class SendRequestCheckMessagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        $this->checkChatsMessage();



    }

    public function checkChatsMessage()
    {
        //dd();


            $message = ChatMessage::latest()->first();
            if (!session()->exists('lastMessage')) {
                session()->put('lastMessage', $message->id);
            }
            //session()->put('lastMessage', 0);
            //dd($message->owner_id);
            if (session('lastMessage') != $message->id and $message->owner_id != auth()->guard('admin')->user()->id) {
                //dd(session('lastMessage'));
                //dd($message->id);
                session()->put('lastMessage', $message->id);
                return true;

            }

    }

}
