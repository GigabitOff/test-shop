<?php

namespace App\Jobs;

use App\Models\SiteReferrer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SiteReferrerResolve implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 2;

    protected SiteReferrer $siteReferrer;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SiteReferrer $referrer)
    {
        $this->siteReferrer = $referrer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $url = $this->siteReferrer->referrer_url;
        $content = file_get_contents($url);
        if (preg_match('/<title>(.*?)<\/title>/is', $content, $matches)) {
            $this->siteReferrer->update([
                'referrer_title' => $matches[1] ?? '',
            ]);
        }
    }
}
