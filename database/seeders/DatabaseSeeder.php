<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\ProdukVarian;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin ─────────────────────────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'admin@cake.com'],
            [
                'name'     => 'Admin Ayasha',
                'password' => bcrypt('admin123'),
                'role'     => 'admin',
            ]
        );

        // ── Kategori ──────────────────────────────────────────────────────────
        $eidCookies    = Kategori::firstOrCreate(['nama_kategori' => 'Eid Cookies']);
        $birthdayCakes = Kategori::firstOrCreate(['nama_kategori' => 'Birthday Cakes']);
        $snackBox      = Kategori::firstOrCreate(['nama_kategori' => 'Snack Box']);
        $softCakes     = Kategori::firstOrCreate(['nama_kategori' => 'Soft Cakes']);

        // ── Helper: buat produk + varian ──────────────────────────────────────
        // $varians = [['nama_varian'=>'Sedang','harga'=>80000,'berat'=>300,'ukuran'=>'16x16 cm'], ...]
        $buatProduk = function (array $data, array $varians = []) {
            $produk = Produk::firstOrCreate(
                ['nama_produk' => $data['nama_produk']],
                $data
            );

            foreach ($varians as $v) {
                ProdukVarian::firstOrCreate(
                    [
                        'produk_id'   => $produk->id,
                        'nama_varian' => $v['nama_varian'],
                    ],
                    [
                        'harga'  => $v['harga'],
                        'berat'  => $v['berat']  ?? null,
                        'ukuran' => $v['ukuran'] ?? null,
                    ]
                );
            }

            return $produk;
        };

        // ── Eid Cookies (tanpa varian) ────────────────────────────────────────
        $eidList = [
            ['nama_produk' => 'Nastar',         'deskripsi' => 'Kue lembut dengan isian selai nanas manis dan sedikit asam, lumer di mulut dan jadi favorit saat Lebaran.',   'harga' => 70000, 'stok' => 80],
            ['nama_produk' => 'Kastengel',       'deskripsi' => 'Kue keju gurih dengan tekstur renyah dan aroma khas keju yang menggugah selera.',                             'harga' => 70000, 'stok' => 30],
            ['nama_produk' => 'Semprit',         'deskripsi' => 'Kue kering klasik berbentuk bunga dengan rasa manis.',                                                        'harga' => 70000, 'stok' => 40],
            ['nama_produk' => 'Putri Salju',     'deskripsi' => 'Kue lembut bertabur gula halus yang manis, langsung lumer saat digigit.',                                     'harga' => 70000, 'stok' => 40],
            ['nama_produk' => 'Sagu Keju',       'deskripsi' => 'Kue ringan dan renyah dengan perpaduan rasa sagu dan keju yang gurih.',                                       'harga' => 70000, 'stok' => 30],
            ['nama_produk' => 'Kue Choco Chips', 'deskripsi' => 'Kue renyah dengan taburan cokelat chips yang manis dan disukai banyak orang.',                               'harga' => 70000, 'stok' => 45],
            ['nama_produk' => 'Kue Cornflakes',  'deskripsi' => 'Kue renyah dengan campuran cornflakes yang gurih manis, cocok untuk camilan Lebaran.',                        'harga' => 70000, 'stok' => 40],
            ['nama_produk' => 'Kue Kacang',      'deskripsi' => 'Kue tradisional dengan rasa kacang yang gurih dan tekstur yang lembut serta sedikit renyah.',                 'harga' => 65000, 'stok' => 30],
        ];

        foreach ($eidList as $data) {
            $buatProduk(array_merge($data, ['gambar' => null, 'kategori_id' => $eidCookies->id]));
        }

        // ── Soft Cakes (dengan varian Sedang & Besar) ─────────────────────────
        $varianSoftCakes = [
            ['nama_varian' => 'Sedang', 'harga' => 80000,  'berat' => 400, 'ukuran' => '18x18 cm'],
            ['nama_varian' => 'Besar',  'harga' => 120000, 'berat' => 700, 'ukuran' => '24x24 cm'],
        ];

        $softList = [
            ['nama_produk' => 'Bolu Cokelat',     'deskripsi' => 'Bolu lembut dengan rasa cokelat yang manis dan nikmat.',                           'harga' => 80000, 'stok' => null],
            ['nama_produk' => 'Bolu Keju',         'deskripsi' => 'Bolu empuk dengan taburan keju gurih yang lezat.',                                 'harga' => 80000, 'stok' => null],
            ['nama_produk' => 'Bolu Marmer',       'deskripsi' => 'Bolu dengan motif marmer cantik, perpaduan rasa vanilla dan cokelat.',             'harga' => 80000, 'stok' => null],
            ['nama_produk' => 'Bolu Pandan',       'deskripsi' => 'Bolu pandan lembut dengan aroma harum khas pandan yang menggugah selera.',         'harga' => 80000, 'stok' => null],
            ['nama_produk' => 'Brownies Cokelat',  'deskripsi' => 'Brownies padat dan lembut dengan rasa cokelat yang rich.',                         'harga' => 80000, 'stok' => null],
            ['nama_produk' => 'Brownies Kacang',   'deskripsi' => 'Brownies dengan topping kacang yang renyah dan gurih.',                            'harga' => 80000, 'stok' => null],
            ['nama_produk' => 'Brownies Keju',     'deskripsi' => 'Brownies lezat dengan tambahan keju yang gurih dan creamy.',                       'harga' => 80000, 'stok' => null],
            ['nama_produk' => 'Brownies Pandan',   'deskripsi' => 'Brownies lembut dengan aroma pandan yang harum dan rasa manis yang khas.',         'harga' => 80000, 'stok' => null],
        ];

        foreach ($softList as $data) {
            $buatProduk(
                array_merge($data, ['gambar' => null, 'kategori_id' => $softCakes->id]),
                $varianSoftCakes
            );
        }

        // ── Birthday Cakes (dengan varian ukuran) ────────────────────────────
        $varianBirthday = [
            ['nama_varian' => 'Ukuran 16 cm', 'harga' => 150000, 'berat' => 500,  'ukuran' => '16 cm'],
            ['nama_varian' => 'Ukuran 20 cm', 'harga' => 200000, 'berat' => 800,  'ukuran' => '20 cm'],
            ['nama_varian' => 'Ukuran 24 cm', 'harga' => 280000, 'berat' => 1200, 'ukuran' => '24 cm'],
        ];

        $birthdayList = [
            ['nama_produk' => 'Chocolate Tart', 'deskripsi' => 'Kue ulang tahun lembut dengan krim cokelat manis yang disukai semua usia.',                   'harga' => 150000],
            ['nama_produk' => 'Cheese Tart',    'deskripsi' => 'Kue ulang tahun empuk dengan krim keju gurih dan creamy.',                                     'harga' => 150000],
            ['nama_produk' => 'Lavender Tart',  'deskripsi' => 'Kue ulang tahun lembut dengan aroma lavender yang harum dan rasa manis yang elegan.',          'harga' => 150000],
        ];

        foreach ($birthdayList as $data) {
            $buatProduk(
                array_merge($data, ['gambar' => null, 'stok' => null, 'kategori_id' => $birthdayCakes->id]),
                $varianBirthday
            );
        }

        // ── Snack Box (dengan varian isi) ─────────────────────────────────────
        $snackList = [
            [
                'produk'  => ['nama_produk' => 'Snack Box Mini',    'deskripsi' => 'Paket snack box mini berisi aneka kue kering pilihan, cocok untuk acara kecil.',     'harga' => 50000,  'stok' => 20],
                'varians' => [
                    ['nama_varian' => '5 Pcs',  'harga' => 50000,  'berat' => 200, 'ukuran' => null],
                    ['nama_varian' => '10 Pcs', 'harga' => 90000,  'berat' => 400, 'ukuran' => null],
                ],
            ],
            [
                'produk'  => ['nama_produk' => 'Snack Box Regular', 'deskripsi' => 'Paket snack box reguler dengan pilihan kue kering yang lebih beragam.',              'harga' => 85000,  'stok' => 15],
                'varians' => [
                    ['nama_varian' => '10 Pcs', 'harga' => 85000,  'berat' => 400, 'ukuran' => null],
                    ['nama_varian' => '20 Pcs', 'harga' => 150000, 'berat' => 800, 'ukuran' => null],
                ],
            ],
            [
                'produk'  => ['nama_produk' => 'Snack Box Premium', 'deskripsi' => 'Paket snack box premium dengan kue pilihan berkualitas tinggi untuk acara spesial.', 'harga' => 150000, 'stok' => 10],
                'varians' => [
                    ['nama_varian' => '15 Pcs', 'harga' => 150000, 'berat' => 600,  'ukuran' => null],
                    ['nama_varian' => '30 Pcs', 'harga' => 270000, 'berat' => 1200, 'ukuran' => null],
                ],
            ],
        ];

        foreach ($snackList as $item) {
            $buatProduk(
                array_merge($item['produk'], ['gambar' => null, 'kategori_id' => $snackBox->id]),
                $item['varians']
            );
        }
    }
}
