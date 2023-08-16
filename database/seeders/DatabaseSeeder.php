<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\Fund;
use App\Models\FundAlias;
use App\Models\FundManager;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        FundManager::factory()
            ->count(10)
            ->has(
                Fund::factory()
                    ->has(Company::factory()->count(3), 'companies')
                    ->has(
                        FundAlias::factory()
                            ->state(function (array $attributes, Fund $fund) {
                                return ['fund_id' => $fund->id];
                            })->count(3),
                        'aliases'
                    )
                    ->count(3)
            )
            ->create();
    }
}
