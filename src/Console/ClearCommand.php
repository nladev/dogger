<?php

namespace Cracki\Dogger\Console;

use Cracki\Dogger\Models\Dlog;
use Illuminate\Console\Command;


class ClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dogger:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the commands necessary to clear all log';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        Dlog::truncate();
        $this->info('All dogger log cleared!');
    }
}
