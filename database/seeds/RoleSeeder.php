<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')
            ->insert([
                ['name' => 'admin'],
                ['name' => 'user'],
            ]);

        $this->command->line('Role Admin and User Created');
        $this->command->line('the request lasted  ' . microtime(true) . ' ms');

    }

}
