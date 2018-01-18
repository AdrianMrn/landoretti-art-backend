<?php

use Illuminate\Database\Seeder;

use App\Style;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $style = new Style;
        
        $style->name = 'Modern';
        
        $style->save();
    }
}
