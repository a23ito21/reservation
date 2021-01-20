<?php

use Illuminate\Database\Seeder;
use App\ReservationForm;

class ReservationFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReservationForm::create([
			"name1" => "伊藤",
            "name2" => "明代",
            "name3" => "いとう",
            "name4" => "あきよ",
            "email" => "XXX@XXX",
            "date" => "2020/12/12",
            "reservation_plan" => "YYYYY",           
            "rnum" => "XXXXXXXX",
        ]);
    }
}
