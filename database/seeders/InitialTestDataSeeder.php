<?php

namespace Database\Seeders;

use App\Services\FirmaService;
use Illuminate\Database\Seeder;

class InitialTestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(FirmaService $firmaService): void
    {
        $firmaService->sync();
    }
}
