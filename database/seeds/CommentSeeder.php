<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comments = factory(App\Comment::class, 100)->create();

        $this->command->line('Created  ' . count($comments) . '  comments');
        $this->command->line('the request lasted  ' . microtime(true) . ' ms');
    }
}
