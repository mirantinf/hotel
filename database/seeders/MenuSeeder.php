<?php

namespace Database\Seeders;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data= [
            [
                'nama_menu' => 'Ayam Goreng Crispy',
                'harga_menu' => 55000,
                'gambar_menu' => 'ayam_goreng_crispy.jpg',
                'stok' => mt_rand(50,120),
                'kategori' => 'makanan'
            ],
            [
                'nama_menu' => 'Ayam Goreng Mentega',
                'harga_menu' => 55000,
                'gambar_menu' => 'ayam_goreng_mentega.jpg',
                'stok' => mt_rand(50,120),
                'kategori' => 'makanan'
            ],
            [
                'nama_menu' => 'Chicken Steak',
                'harga_menu' => 69000,
                'gambar_menu' => 'chicken_steak.jpg',
                'stok' => mt_rand(50,120),
                'kategori' => 'makanan'
            ],
            [
                'nama_menu' => 'Fish and Chips',
                'harga_menu' => 42500,
                'gambar_menu' => 'fishnchips.jpg',
                'stok' => mt_rand(50,120),
                'kategori' => 'makanan'
            ],
            [
                'nama_menu' => 'Gurame Asam Manis',
                'harga_menu' => 79000,
                'gambar_menu' => 'gurame_asam_manis.jpg',
                'stok' => mt_rand(50,120),
                'kategori' => 'makanan'
            ],
            [
                'nama_menu' => 'Jus Alpukat',
                'harga_menu' => 20000,
                'gambar_menu' => 'jus_alpukat.jpg',
                'stok' => mt_rand(50,120),
                'kategori' => 'minuman'
            ],
            [
                'nama_menu' => 'Jus Jeruk',
                'harga_menu' => 15000,
                'gambar_menu' => 'jus_jeruk.jpg',
                'stok' => mt_rand(50,120),
                'kategori' => 'minuman'
            ],
            [
                'nama_menu' => 'Jus Mangga',
                'harga_menu' => 15000,
                'gambar_menu' => 'jus_mangga.jpg',
                'stok' => mt_rand(50,120),
                'kategori' => 'minuman'
            ],
            [
                'nama_menu' => 'Jus Strawberry',
                'harga_menu' => 15000,
                'gambar_menu' => 'jus_strawberry.jpg',
                'stok' => mt_rand(50,120),
                'kategori' => 'minuman'
            ],
            [
                'nama_menu' => 'Sapi Lada Hitam',
                'harga_menu' => 65000,
                'gambar_menu' => 'sapi_lada_hitam.jpg',
                'stok' => mt_rand(50,120),
                'kategori' => 'makanan'
            ],
            [
                'nama_menu' => 'Sate Ayam',
                'harga_menu' => 50000,
                'gambar_menu' => 'sate_ayam.jpg',
                'stok' => mt_rand(50,120),
                'kategori' => 'makanan'
            ],
            [
                'nama_menu' => 'Sirloin Steak',
                'harga_menu' => 89000,
                'gambar_menu' => 'sirloin_steak.jpg',
                'stok' => mt_rand(50,120),
                'kategori' => 'makanan'
            ],
            [
                'nama_menu' => 'Sop Buntut',
                'harga_menu' => 75000,
                'gambar_menu' => 'sop_buntut.jpg',
                'stok' => mt_rand(50,120),
                'kategori' => 'makanan'
            ],
            [
                'nama_menu' => 'Sop Tulang Iga Bakar Sapi',
                'harga_menu' => 57500,
                'gambar_menu' => 'sop_tulang_iga_bakar_sapi.jpg',
                'stok' => mt_rand(50,120),
                'kategori' => 'makanan'
            ],
            [
                'nama_menu' => 'Sop Tulang Iga Bakar Sapi',
                'harga_menu' => 57500,
                'gambar_menu' => 'sop_tulang_iga_kuah.jpg',
                'stok' => mt_rand(50,120),
                'kategori' => 'makanan'
            ],
            [
                'nama_menu' => 'Soto Betawi',
                'harga_menu' => 46000,
                'gambar_menu' => 'soto_betawi.jpg',
                'stok' => mt_rand(50,120),
                'kategori' => 'makanan'
            ],
            [
                'nama_menu' => 'Spaghetti Bolognese',
                'harga_menu' => 55000,
                'gambar_menu' => 'spaghetti_bolognese.jpg',
                'stok' => mt_rand(50,120),
                'kategori' => 'makanan'
            ],
        ];

        foreach ($data as $item) {
            DB::table('menu')->insert([
                'id' => Uuid::uuid4()->toString(),
                'nama_menu' => $item['nama_menu'],
                'harga_menu' => $item['harga_menu'],
                'gambar_menu' => $item['gambar_menu'],
                'stok' => $item['stok'],
                'kategori' => $item['kategori'],
                'deskripsi' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quasi eius aliquam recusandae non quae in ut? Corrupti consectetur optio fugit.'
            ]);
        }
    }
}
