<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        for($i=0; $i<10; $i++){
            Book::create([
                'kode_buku'=>$faker->numberBetween(100,200),
                'judul_buku'=>$faker->unique()->sentence,
                'kategori'=>$faker->word,
                'pengarang'=>$faker->name,
                'penerbit'=>$faker->company,
                'tanggal_publikasi'=>$faker->date,
                'stock'=>$faker->numberBetween(50,500),
                'status'=>$faker->word,


               
            ]);
        }
    }
}
