<?php

namespace Database\Seeders\Apply;

use Database\Seeders\DatabaseSeeder;
use Domain\Apply\Models\Company;
use Domain\Apply\Models\Prefecture;
use Domain\Apply\Models\ShokushuItem;

class ApplySeeder extends DatabaseSeeder
{
    public function run(): void
    {
        $user = $this->testUser();

        $companies = Company::factory(10)->for($user)->create();
        Prefecture::factory(10)->create();
        ShokushuItem::factory(40)->create();
    }
}
