<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Session;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OcupationSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(BradeSeeder::class);
        $this->call(CollaboratorSeeder::class);
        $this->call(SaleSeeder::class);
        $this->call(StyleSeeder::class);
        $this->call(ConditionSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PeopleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RoleUserSeeder::class);
    }
}
