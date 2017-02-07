<?php

use Illuminate\Database\Seeder;
use DB; 


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        
        for ($i=0; $i < 50; $i++) {
            
            DB::table('users')->insert(
				[
					'name' => 'nombre '.$i,
                    'email'  => 'user'.$i.'@apimain.com',
                    'Image'=>'http://someserver/images/24db40c530.jpg'
				]
			);
        }
    }
}
