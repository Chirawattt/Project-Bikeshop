<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branch')->insert(array(
            ['name' => 'นครนายก'],
            ['name' => 'กรุงเทพ'],
            ['name' => 'ชลบุรี']
        ));
    }
}
