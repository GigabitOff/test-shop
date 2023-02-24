<?php

namespace App\Console\Commands;

use App\Actions\ProcessProductImport;
use App\Models\ProductImport;
use App\Services\ProductImporters\ProductArrayImporter;
use App\Services\ProductImporters\ProductXmlImporter;
use Illuminate\Console\Command;

class ImportsProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imports:work
        {type : Type of task processed. One of single, repeatable}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run worker to process import tasks';

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
        if ($this->wrongType()){
            $this->error('Wrong param type! Please select `single` or `repeatable`.');
            return 1;
        }

        while (true) {
            $task = ProductImport::query()
                ->notProcessing()
                ->onlyEnabled()
                ->when($this->isTypeSingle(), fn($q) => $q->notExecuted())
                ->when($this->isTypePeriodic(), function ($q) {
                    $q->onlyRepeatable();
                    $q->where('processed_at', '<=', now()->subDay());
                })
                ->first();

            if (!$task) {
                break;
            }

            (new ProcessProductImport)($task);
        }
        return 0;
    }


    private function isTypePeriodic(): bool
    {
        return 'repeatable' === $this->argument('type');
    }

    private function isTypeSingle(): bool
    {
        return 'single' === $this->argument('type');
    }

    private function wrongType(): bool
    {
        return ! in_array($this->argument('type'), ['single', 'repeatable']);
    }
}
