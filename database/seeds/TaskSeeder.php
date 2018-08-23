<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $task = factory(App\Task::class, 50)->create();

        $this->command->line('Created '.$task->count().' tasks');
        $this->command->line('the request lasted  ' . microtime(true) . ' ms');

    }
}
