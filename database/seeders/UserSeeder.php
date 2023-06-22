<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
  
            $report = fopen(base_path("database/data/member.csv"), "r");
    
            $dataRow = true;
            while (($data = fgetcsv($report, 4000, ",")) !== FALSE) {
                if (!$dataRow) {
                    User::create([
                        "user_id" => rand(00000,99999),
                        "title" => $data['1'],
                        "first_name" => $data['2'],
                        "last_name" => $data['3'],
                        "gender" => $data['5'],
                        "phone" => $data['6'],
                        "user_type" => $data['7'],
                        "email" => $data['10'],
                        "password" => $data['11'],
                        "member_status" => $data['15'],
                        "acc_status" => "1",
                        "created_at" => $data['12'],
                    ]);    
                }
                $dataRow = false;
            }
   
        fclose($report);
    }
}
