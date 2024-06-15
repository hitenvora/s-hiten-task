<?php

namespace Database\Seeders;

use App\Models\product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data=[
                [
                    "product_name"=>"AC (Cassette)",
                ],
                [
                    "product_name"=>"AC (Ducteble)",
                ],
                [
                    "product_name"=>"AC (Split)",
                ],
                [
                    "product_name"=>"Copper Piping",
                ]
            ];

            foreach($data as $row)
            {
                $flight = product::create($row);
            }
    }
}
