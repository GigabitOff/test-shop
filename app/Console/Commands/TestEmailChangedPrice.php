<?php

namespace App\Console\Commands;

use App\Actions\EmailChangedProductPrices;
use Illuminate\Console\Command;

class TestEmailChangedPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email-changed-price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send changed price email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        (new EmailChangedProductPrices())();

        return 0;
    }
}
