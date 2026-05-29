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
                'password' => 'admin123', // Hashing otomatis oleh model User
                'role'     => 'admin',
            ]
        );

        // ── Kategori ──────────────────────────────────────────────────────────
        $eidCookies    = Kategori::firstOrCreate(['nama_kategori' => 'Eid Cookies']);
        $birthdayCakes = Kategori::firstOrCreate(['nama_kategori' => 'Birthday Cakes']);
        $snackBox      = Kategori::firstOrCreate(['nama_kategori' => 'Snack Box']);
        $softCakes     = Kategori::firstOrCreate(['nama_kategori' => 'Soft Cakes']);

        // ── Helper: buat produk + varian ──────────────────────────────────────
        $buatProduk = function (array $data, array $varians = []) {
            // Gunakan updateOrCreate agar data gambar di database diperbarui sesuai seeder
            $produk = Produk::updateOrCreate(
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
            ['nama_produk' => 'Nastar',         'deskripsi' => 'Kue lembut dengan isian selai nanas manis dan sedikit asam, lumer di mulut dan jadi favorit saat Lebaran.',   'harga' => 70000, 'stok' => 80, 'gambar' => 'Nastar.png'],
            ['nama_produk' => 'Kastengel',       'deskripsi' => 'Kue keju gurih dengan tekstur renyah dan aroma khas keju yang menggugah selera.',                             'harga' => 70000, 'stok' => 30, 'gambar' => 'Kastengel.png'],
            ['nama_produk' => 'Semprit',         'deskripsi' => 'Kue kering klasik berbentuk bunga dengan rasa manis.',                                                        'harga' => 70000, 'stok' => 40, 'gambar' => 'Semprit.png'],
            ['nama_produk' => 'Putri Salju',     'deskripsi' => 'Kue lembut bertabur gula halus yang manis, langsung lumer saat digigit.',                                     'harga' => 70000, 'stok' => 40, 'gambar' => 'PutriSalju.png'],
            ['nama_produk' => 'Sagu Keju',       'deskripsi' => 'Kue ringan dan renyah dengan perpaduan rasa sagu dan keju yang gurih.',                                       'harga' => 70000, 'stok' => 30, 'gambar' => 'SaguKeju.png'],
            ['nama_produk' => 'Kue Choco Chips', 'deskripsi' => 'Kue renyah dengan taburan cokelat chips yang manis dan disukai banyak orang.',                               'harga' => 70000, 'stok' => 45, 'gambar' => 'ChocoChips.png'],
            ['nama_produk' => 'Kue Cornflakes',  'deskripsi' => 'Kue renyah dengan campuran cornflakes yang gurih manis, cocok untuk camilan Lebaran.',                        'harga' => 70000, 'stok' => 40, 'gambar' => 'Cornfleks.png'],
            ['nama_produk' => 'Kue Kacang',      'deskripsi' => 'Kue tradisional dengan rasa kacang yang gurih dan tekstur yang lembut serta sedikit renyah.',                 'harga' => 65000, 'stok' => 30, 'gambar' => 'Kacang.jpg'],
        ];

        foreach ($eidList as $data) {
            $buatProduk(array_merge($data, ['kategori_id' => $eidCookies->id]));
        }

        // ── Soft Cakes (dengan varian Sedang & Besar) ─────────────────────────
        $varianSoftCakes = [
            ['nama_varian' => 'Sedang', 'harga' => 80000,  'berat' => 400, 'ukuran' => '18x18 cm'],
            ['nama_varian' => 'Besar',  'harga' => 120000, 'berat' => 700, 'ukuran' => '24x24 cm'],
        ];

        $softList = [
            ['nama_produk' => 'Bolu Cokelat',     'deskripsi' => 'Bolu lembut dengan rasa cokelat yang manis dan nikmat.',                           'harga' => 80000, 'stok' => null, 'gambar' => 'BoluCokelat.png'],
            ['nama_produk' => 'Bolu Keju',         'deskripsi' => 'Bolu empuk dengan taburan keju gurih yang lezat.',                                 'harga' => 80000, 'stok' => null, 'gambar' => 'BoluKeju.png'],
            ['nama_produk' => 'Bolu Marmer',       'deskripsi' => 'Bolu dengan motif marmer cantik, perpaduan rasa vanilla dan cokelat.',             'harga' => 80000, 'stok' => null, 'gambar' => 'BoluMarmer.png'],
            ['nama_produk' => 'Bolu Pandan',       'deskripsi' => 'Bolu pandan lembut dengan aroma harum khas pandan yang menggugah selera.',         'harga' => 80000, 'stok' => null, 'gambar' => 'BoluPandan.png'],
            ['nama_produk' => 'Mini Black Forest',  'deskripsi' => 'Perpaduan bolu cokelat lembut, krim creamy, dan serutan cokelat premium yang manis dan lezat di setiap gigitan.',                         'harga' => 80000, 'stok' => null, 'gambar' => 'MiniBlackForest.png'],
            ['nama_produk' => 'Brownies Kacang',   'deskripsi' => 'Brownies dengan topping kacang yang renyah dan gurih.',                            'harga' => 80000, 'stok' => null, 'gambar' => 'BrowniesKacang.png'],
            ['nama_produk' => 'Brownies Keju',     'deskripsi' => 'Brownies lezat dengan tambahan keju yang gurih dan creamy.',                       'harga' => 80000, 'stok' => null, 'gambar' => 'BrowniesKeju.png'],
            ['nama_produk' => 'Brownies Pandan',   'deskripsi' => 'Brownies lembut dengan aroma pandan yang harum dan rasa manis yang khas.',         'harga' => 80000, 'stok' => null, 'gambar' => 'BoluPandan.png'],
        ];

        foreach ($softList as $data) {
            $buatProduk(
                array_merge($data, ['kategori_id' => $softCakes->id]),
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
            ['nama_produk' => 'Cheese Tart',       'deskripsi' => 'Kue tart dengan rasa keju yang gurih dan tekstur yang lembut di mulut.',           'harga' => 180000, 'stok' => null, 'gambar' => 'CheeseTart.png'],
            ['nama_produk' => 'Chocolate Tart',    'deskripsi' => 'Kue tart cokelat premium dengan rasa cokelat yang mendalam dan memanjakan lidah.', 'harga' => 180000, 'stok' => null, 'gambar' => 'ChoclateTart.png'],
            ['nama_produk' => 'Lavender Tart',     'deskripsi' => 'Kue tart unik dengan sentuhan aroma lavender yang menenangkan dan rasa manis.',   'harga' => 190000, 'stok' => null, 'gambar' => 'LavenderTart.png'],
        ];

        foreach ($birthdayList as $data) {
            $buatProduk(
                array_merge($data, ['kategori_id' => $birthdayCakes->id]),
                $varianBirthday
            );
        }

        // ── Snack Box (tanpa varian) ──────────────────────────────────────────
        $snackList = [
            ['nama_produk' => 'Pastel',           'deskripsi' => 'Pastel renyah dengan isian sayuran dan telur yang gurih.',                         'harga' => 5000,  'stok' => 50, 'gambar' => 'Pastel.png'],
            ['nama_produk' => 'Risol',            'deskripsi' => 'Risol lezat dengan kulit yang renyah dan isian yang melimpah.',                    'harga' => 5000,  'stok' => 50, 'gambar' => 'Risol.png'],
            ['nama_produk' => 'Dadar Gulung',     'deskripsi' => 'Kue tradisional dengan kulit pandan dan isian unti kelapa manis.',                'harga' => 4000,  'stok' => 40, 'gambar' => 'DadarGulung.png'],
            ['nama_produk' => 'Kue Sus',          'deskripsi' => 'Kue sus lembut dengan isian vla vanilla yang creamy dan manis.',                   'harga' => 5000,  'stok' => 40, 'gambar' => 'KueSusVlaVanila.png'],
            ['nama_produk' => 'Kue Nagasari',     'deskripsi' => 'Kue tradisional berbahan tepung beras dengan isian pisang yang manis dan lembut.', 'harga' => 4000,  'stok' => 35, 'gambar' => 'KueNagasari.png'],
            ['nama_produk' => 'Donat Meses',      'deskripsi' => 'Donat empuk dengan taburan meses cokelat yang melimpah.',                          'harga' => 5000,  'stok' => 45, 'gambar' => 'DonatMeses&Keju.png'],
            ['nama_produk' => 'Roti Isi',         'deskripsi' => 'Roti lembut dengan berbagai pilihan isian yang lezat.',                             'harga' => 6000,  'stok' => 40, 'gambar' => 'RotiIsi.png'],
            ['nama_produk' => 'Pie Buah',         'deskripsi' => 'Pie renyah dengan topping buah segar dan vla manis.',                              'harga' => 6000,  'stok' => 35, 'gambar' => 'PieBuah.png'],
        ];

        foreach ($snackList as $data) {
            $buatProduk(array_merge($data, ['kategori_id' => $snackBox->id]));
        }
    }
}
