<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Career::create([
            'name'=>'ITI',
            'description' => 'Se programa mucho, muchos barcos, muchos homosexuales.'
        ]);

        Career::create([
            'name'=>'Meca',
            'description' => 'Los profes te maltratan, hay mucha gente rara con masculinidad fragil y tiran mal rollo.'
        ]);

        Career::create([
            'name'=>'ISA',
            'description' => 'Grupos de puros hombre, la carne asada y volarse ingles para jugar fucho son tradición'
        ]);

        Career::create([
            'name'=>'LAyGE',
            'description' => 'Siempre estan afuera estos compas parece que no tienen clase.'
        ]);

        Career::create([
            'name'=>'Comercio',
            'description' => 'Como LAyGE pero las clases son en ingles.'
        ]);

        Career::create([
            'name'=>'Manu',
            'description' => 'Nadie se mete a esta cosa y ademas les cae bien raquel, -10 de aura.'
        ]);
    }
}
