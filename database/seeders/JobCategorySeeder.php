<?php

namespace Database\Seeders;

use App\Models\JobCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobCategoies = [
           [ 'category' => 'HVAC']
        ];

        foreach ($jobCategoies as $jobCategory) {
              $addCactegory = JobCategory::where('category',$jobCategory['category'])->first();
              if(!$addCactegory){
                  $addCactegory = new JobCategory();
              }
              $addCactegory->category = $jobCategory['category'];
              $addCactegory->save();
        }
    }
}
