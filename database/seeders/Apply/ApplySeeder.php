<?php

namespace Database\Seeders\Apply;

use App\Models\Company;
use App\Models\Entry;
use App\Models\Prefecture;
use App\Models\Recruit;
use App\Models\ShokushuItem;
use Database\Seeders\DatabaseSeeder;

class ApplySeeder extends DatabaseSeeder
{
	public function run(): void
	{
		$user = $this->testUser();

		$companies = Company::factory(10)->for($user)->create();

		$companies->each(
			function (Company $company) {
				Entry::factory(10)->for($company)->create();
			}
		);

		Prefecture::factory(10)->create();

		$shokushuItems = ShokushuItem::factory(40)->create();
		$recruits = Recruit::factory(100)->create();

		$shokushuItems->each(function ($shokushuItem) use ($recruits) {
            $shokushuItem->recruits()->attach(
                $recruits->random(rand(1, 4))->pluck('id')->toArray()
            );
        });
	}
}
