<?php

namespace App\Console\Commands;

use App\Services\FirmaService;
use App\Services\LinkerService;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class SyncData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync data from Firma and Linker systems';

    /**
     * Execute the console command.
     */
    public function handle(FirmaService $firmaService, LinkerService $linkerService): int
    {
        $this->info('Starting data sync');

        $firmaService->sync();
        $this->info('Firma data synced');

        $linkerService->sync();
        $this->info('Linker data synced');

        $this->info('All data synced successfully.');
        return CommandAlias::SUCCESS;
    }
}
