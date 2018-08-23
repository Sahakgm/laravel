<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = factory(App\User::class)->create(['role_id' => 1]);
        $users = factory(App\User::class, 5)->create(['role_id' => 2]);

        $this->command->line('Created  '. $admin .' Admin and ' . count($users) . '  users');
        $this->command->line('the request lasted  ' . microtime(true) . ' ms');

    }
}
