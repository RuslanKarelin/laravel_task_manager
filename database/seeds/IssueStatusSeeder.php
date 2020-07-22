<?php

use Illuminate\Database\Seeder;
use \App\Models\TaskManager\IssueStatus;

class IssueStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IssueStatus::insert([
            ['name' => 'Новая задача'],
            ['name' => 'В работе'],
            ['name' => 'Приостановлено'],
            ['name' => 'Обратная связь'],
            ['name' => 'Решена'],
            ['name' => 'Закрыта'],
            ['name' => 'Оплачена']
        ]);
    }
}
