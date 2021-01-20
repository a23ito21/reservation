<?php

use Illuminate\Database\Seeder;
use App\ReservationPlan;

class ReservationPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReservationPlan::create([
            "reservation_plan" => "一泊二日九州ツアー", 
        ]);
  
    }
}
