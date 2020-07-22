<?php

use Illuminate\Database\Seeder;

class MasterProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\Models\Masterproducts::create(
          [
                'name'  => 'Apple',
                'keyword' => 'iphone'
          ]
      );

      \App\Models\Masterproducts::create(
          [
                'name'  => 'Samsung',
                'keyword' => 'galaxy'
          ]
      );
    }
}
