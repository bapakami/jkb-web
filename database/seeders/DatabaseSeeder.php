<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Career;
use App\Models\Client;
use App\Models\News;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Project;
use App\Models\Setting;
use App\Models\TahukahAnda;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedSettings();
        $this->seedAdmin();
        $this->seedProductCategories();
        $this->seedProjects();
        $this->seedBranches();
        $this->seedClientsAndTestimonials();
        $this->seedNews();
        $this->seedCareers();
        $this->seedTahukahAnda();
    }

    private function seedSettings(): void
    {
        $settings = [
            'company_name' => 'CV Jati Kencana Beton',
            'company_short_name' => 'JKB',
            'tagline' => 'Kokoh Berkualitas',
            'whatsapp' => '08123456789',
            'phone' => '(024) 1234 5678',
            'email' => 'info@jkb.co.id',
            'address' => 'Jl. Raya Semarang – Solo KM 12, Ungaran, Kab. Semarang, Jawa Tengah',
            'operational_hours' => 'Senin – Sabtu, 07.00 – 17.00 WIB',
            'iso_number' => 'ISO 9001:2015',
            'est_year' => '1980',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    private function seedAdmin(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@jkb.co.id'],
            [
                'name' => 'Administrator JKB',
                'password' => Hash::make('jkb@Admin2026'),
            ]
        );
    }

    private function seedProductCategories(): void
    {
        $categories = [
            [
                'name' => 'Beton Ready Mix',
                'description' => 'Beton siap pakai dengan kualitas konsisten, diproduksi di batching plant dan diantarkan truk mixer langsung ke lokasi proyek.',
                'short_description' => 'Beton siap pakai dari berbagai mutu untuk segala jenis struktur.',
                'icon' => 'truck',
                'image' => 'hero/beton-readymix-1.jpg',
                'sort_order' => 1,
            ],
            [
                'name' => 'Beton Pracetak / Precast',
                'description' => 'Komponen beton yang dicetak dan dikeringkan di pabrik sehingga mutunya terkendali, mempercepat waktu konstruksi di lapangan.',
                'short_description' => 'Komponen beton cetak pabrik untuk pembangunan yang cepat dan presisi.',
                'icon' => 'rectangle-group',
                'image' => 'hero/precast-jkb.webp',
                'sort_order' => 2,
            ],
            [
                'name' => 'Material Split & Batu Pecah',
                'description' => 'Batu pecah (split) dan agregat berkualitas untuk kebutuhan pengecoran maupun lapis pondasi jalan (LPB/LPA).',
                'short_description' => 'Agregat dan batu pecah berkualitas untuk pondasi dan pengecoran.',
                'icon' => 'cube',
                'image' => 'kategori/split.webp',
                'sort_order' => 3,
            ],
        ];

        foreach ($categories as $i => $data) {
            $category = ProductCategory::updateOrCreate(['name' => $data['name']], $data);
            $this->seedProducts($category, $i + 1);
        }
    }

    private function seedProducts(ProductCategory $category, int $idx): void
    {
        $catalog = [
            'Beton Ready Mix' => [
                [
                    'name' => 'Ready Mix K-175',
                    'subtitle' => 'Beton untuk struktur non-struktural',
                    'summary' => 'Kelas beton untuk lantai kerja (lean concrete), rabat beton, dan struktur sederhana non-pemikul beban berat.',
                    'specifications' => [
                        'Kuat Tekan' => '175 kg/cm² (K-175)',
                        'Slump' => '8 ± 2 cm',
                        'Penggunaan' => 'Cor lantai kerja, rabat, saluran sederhana',
                        'Waktu Setting' => '± 45 menit awal',
                    ],
                    'uses' => 'Cocok untuk lantai kerja, trotoar, dan pengecoran sederhana yang tidak menahan beban berat.',
                    'sort_order' => 1,
                ],
                [
                    'name' => 'Ready Mix K-225',
                    'subtitle' => 'Beton struktural untuk bangunan umum',
                    'summary' => 'Beton untuk struktur umum seperti kolom, balok, pelat, dan pondasi bangunan rumah tinggal hingga ruko.',
                    'specifications' => [
                        'Kuat Tekan' => '225 kg/cm² (K-225)',
                        'Slump' => '12 ± 2 cm',
                        'Penggunaan' => 'Struktur kolom, balok, pelat lantai',
                        'Tipe Semen' => 'PCC / OPC (sesuai kebutuhan)',
                    ],
                    'uses' => 'Solusi paling populer untuk struktur bangunan rumah, ruko, dan gedung bertingkat rendah.',
                    'sort_order' => 2,
                ],
                [
                    'name' => 'Ready Mix K-300',
                    'subtitle' => 'Beton mutu tinggi untuk struktur utama',
                    'summary' => 'Beton untuk elemen struktur utama gedung bertingkat, jembatan, dan sarana infrastruktur dengan beban besar.',
                    'specifications' => [
                        'Kuat Tekan' => '300 kg/cm² (K-300)',
                        'Slump' => '12 ± 2 cm',
                        'Penggunaan' => 'Struktur gedung, jembatan, dinding penahan tanah',
                        'Agregat' => 'Batu pecah 1-2 mm grade A',
                    ],
                    'uses' => 'Untuk proyek infrastruktur dan gedung bertingkat yang membutuhkan kekuatan struktur optimal.',
                    'sort_order' => 3,
                ],
                [
                    'name' => 'Ready Mix K-350',
                    'subtitle' => 'Beton mutu tinggi untuk proyek besar',
                    'summary' => 'Beton dengan kuat tekan tinggi untuk struktur yang membutuhkan daya dukung sangat besar seperti pile cap dan kolom gedung tinggi.',
                    'specifications' => [
                        'Kuat Tekan' => '350 kg/cm² (K-350)',
                        'Slump' => '12 ± 2 cm',
                        'Penggunaan' => 'Pile cap, kolom gedung tinggi, struktur jembatan',
                        'Admixture' => 'Superplasticizer sesuai mix design',
                    ],
                    'uses' => 'Untuk proyek gedung menengah-tinggi dan infrastruktur berat yang membutuhkan mutu beton tinggi.',
                    'sort_order' => 4,
                ],
                [
                    'name' => 'Ready Mix K-400',
                    'subtitle' => 'Beton mutu tinggi untuk struktur khusus',
                    'summary' => 'Beton mutu tinggi untuk struktur khusus seperti slab jembatan, beton prategang, dan pekerjaan yang memerlukan kuat tekan 400 kg/cm².',
                    'specifications' => [
                        'Kuat Tekan' => '400 kg/cm² (K-400)',
                        'Slump' => '12 ± 2 cm',
                        'Penggunaan' => 'Slab jembatan, beton prategang, struktur khusus',
                        'Admixture' => 'WRA / Superplasticizer high range',
                    ],
                    'uses' => 'Untuk pekerjaan struktur khusus yang membutuhkan keawetan dan kekuatan tinggi.',
                    'sort_order' => 5,
                ],
                [
                    'name' => 'Ready Mix K-450',
                    'subtitle' => 'Beton mutu sangat tinggi',
                    'summary' => 'Beton dengan mutu sangat tinggi untuk kebutuhan struktur prestisius yang menuntut performa maksimal.',
                    'specifications' => [
                        'Kuat Tekan' => '450 kg/cm² (K-450)',
                        'Slump' => '12 ± 2 cm',
                        'Penggunaan' => 'Struktur gedung tinggi, infrastruktur besar',
                        'Admixture' => 'High range superplasticizer',
                    ],
                    'uses' => 'Untuk proyek infrastruktur dan gedung tinggi dengan spesifikasi teknis sangat ketat.',
                    'sort_order' => 6,
                ],
            ],
            'Beton Pracetak / Precast' => [
                [
                    'name' => 'Box Culvert',
                    'subtitle' => 'Gorong-gorong beton pracetak',
                    'summary' => 'Gorong-gorong beton pracetak dengan mutu terkendali untuk saluran air, drainase, dan underpass sederhana.',
                    'specifications' => [
                        'Kuat Tekan' => 'K-300 s.d. K-400',
                        'Dimensi' => '40×40 s.d. 200×200 cm (custom)',
                        'Standar' => 'SNI dan spesifikasi teknis pengguna',
                        'Sambungan' => 'Male-female dengan rubber gasket',
                    ],
                    'uses' => 'Drainase, gorong-gorong jalan, saluran irigasi, dan underpass.',
                    'sort_order' => 1,
                ],
                [
                    'name' => 'U-Ditch',
                    'subtitle' => 'Saluran beton berbentuk U',
                    'summary' => 'Saluran beton pracetak berbentuk huruf U yang praktis dipasang untuk drainase jalan dan kawasan.',
                    'specifications' => [
                        'Kuat Tekan' => 'K-300 s.d. K-350',
                        'Ukuran' => 'Berbagai ukuran dengan tutup precast',
                        'Keunggulan' => 'Pemasangan cepat, permukaan halus',
                        'Toleransi' => 'Ketebalan dinding seragam 10-15 mm',
                    ],
                    'uses' => 'Drainase jalan, drainase kawasan perumahan, dan saluran tepi jalan raya.',
                    'sort_order' => 2,
                ],
                [
                    'name' => 'Pagar Panel',
                    'subtitle' => 'Panel pagar beton kuat & ekonomis',
                    'summary' => 'Pagar beton pracetak yang kokoh, rapi, dan perawatannya minimal untuk pengamanan kawasan dan industri.',
                    'specifications' => [
                        'Kuat Tekan' => 'K-225 s.d. K-300',
                        'Tipe' => 'Panel solid / ruji / ornament',
                        'Dimensi' => 'Height 120-240 cm custom',
                        'Tiang' => 'Tiang kolom praktis dengan pengunci',
                    ],
                    'uses' => 'Pagar kawasan industri, kompleks perumahan, gudang, dan lahan proyek.',
                    'sort_order' => 3,
                ],
                [
                    'name' => 'Balok Precast',
                    'subtitle' => 'Balok beton pracetak',
                    'summary' => 'Balok beton pracetak untuk struktur besar yang mempercepat waktu pengerjaan dan mengurangi bekisting di lapangan.',
                    'specifications' => [
                        'Kuat Tekan' => 'K-300 s.d. K-500',
                        'Panjang' => 'Custom sesuai bentang proyek',
                        'Penguatan' => 'Tulangan wiremesh / baja ulir',
                        'Lifting' => 'Sistem angkur bawaan pabrik',
                    ],
                    'uses' => 'Balok jembatan, balok gudang, dan struktur gedung dengan bentang lebar.',
                    'sort_order' => 4,
                ],
                [
                    'name' => 'Kanstin / Kereb',
                    'subtitle' => 'Kerb & kanstin trotoar',
                    'summary' => 'Kerb beton pracetak untuk pembatas jalan dan trotoar dengan bentuk presisi dan pemasangan cepat.',
                    'specifications' => [
                        'Kuat Tekan' => 'K-300',
                        'Tipe' => 'Kerb tipe K1, K2, K3, dan cincin',
                        'Ketahanan' => 'Tahan abrasi & cuaca',
                        'Warna' => 'Natural abu-abu / merah / pigmen custom',
                    ],
                    'uses' => 'Pembatas trotoar, median jalan, dan tepi taman kota.',
                    'sort_order' => 5,
                ],
                [
                    'name' => 'Tiang Pancang',
                    'subtitle' => 'Mini pile & tiang pancang beton',
                    'summary' => 'Tiang pancang beton pracetak untuk pondasi dalam yang kokoh dan akurat, diproduksi dengan kontrol mutu optimal.',
                    'specifications' => [
                        'Kuat Tekan' => 'K-450 s.d. K-600',
                        'Dimensi' => 'Square pile 25×25, 30×30, 35×35 cm',
                        'Panjang' => '6 m / 12 m (sambungan weld)',
                        'Tulangan' => 'Baja mutu tinggi dengan sambungan plate',
                    ],
                    'uses' => 'Pondasi dalam untuk gedung, jembatan, dan bangunan di tanah lunak.',
                    'sort_order' => 6,
                ],
            ],
            'Material Split & Batu Pecah' => [
                [
                    'name' => 'Batu Split 1-2 (Maks. 2 cm)',
                    'subtitle' => 'Agregat kasar standar pengecoran',
                    'summary' => 'Batu pecah ukuran 1-2 cm yang merupakan agregat utama untuk campuran beton ready mix dan cor konvensional.',
                    'specifications' => [
                        'Ukuran' => '1 - 2 cm',
                        'Sumber' => 'Gunung (andesit / basal)',
                        'Kadar Lempung' => '≤ 1%',
                        'Standar' => 'SNI 1970 / ASTM C33',
                    ],
                    'uses' => 'Campuran beton siap pakai, pengecoran struktur, dan pembuatan precast.',
                    'sort_order' => 1,
                ],
                [
                    'name' => 'Batu Split 2-3 (Maks. 3 cm)',
                    'subtitle' => 'Agregat untuk beton massal',
                    'summary' => 'Batu pecah ukuran 2-3 cm untuk volume pengecoran besar dan lapis pondasi.',
                    'specifications' => [
                        'Ukuran' => '2 - 3 cm',
                        'Sumber' => 'Gunung (andesit / basal)',
                        'Kadar Lempung' => '≤ 1%',
                        'Standar' => 'SNI 1970 / ASTM C33',
                    ],
                    'uses' => 'Cor beton massal, pondasi, dan lapis pondasi jalan (LPB).',
                    'sort_order' => 2,
                ],
                [
                    'name' => 'Abu Batu',
                    'subtitle' => 'Pasir batu halus',
                    'summary' => 'Sisa pecahan batu berukuran halus yang sering dipakai sebagai bahan pengisi dan campuran.',
                    'specifications' => [
                        'Ukuran' => '≤ 5 mm',
                        'Sifat' => 'Kasar & bersudut',
                        'Penggunaan' => 'Pengisi dan campuran',
                        'Standar' => 'SNI 1969',
                    ],
                    'uses' => 'Campuran agregat beton, pemadatan, dan pelapis dasar paving.',
                    'sort_order' => 3,
                ],
                [
                    'name' => 'Batu Makadam',
                    'subtitle' => 'Penguatan lapis pondasi',
                    'summary' => 'Batu pecah ukuran besar untuk lapis pondasi jalan (lapen/lapis penetrasi) dan penguatan tanah.',
                    'specifications' => [
                        'Ukuran' => '3 - 5 cm',
                        'Kekuatan' => 'Batu keras terpilih',
                        'Penggunaan' => 'Lapis pondasi jalan',
                        'Warna' => 'Abu-abu pekat',
                    ],
                    'uses' => 'Lapis pondasi jalan, penguatan halaman, dan tanggul.',
                    'sort_order' => 4,
                ],
                [
                    'name' => 'Pasir Cor (Pasir Beton)',
                    'subtitle' => 'Agregat halus untuk beton',
                    'summary' => 'Pasir cor berkualitas sebagai agregat halus campuran beton dan pasangan yang dianalisa di laboratorium.',
                    'specifications' => [
                        'Kehalusan' => 'FM 2.2 - 3.1',
                        'Sumber' => 'Lereng gunung / sungai terpilih',
                        'Kadar Lumpur' => '≤ 5%',
                        'Standar' => 'SNI 1969',
                    ],
                    'uses' => 'Campuran beton, pasangan bata, dan plesteran.',
                    'sort_order' => 5,
                ],
                [
                    'name' => 'Batuan Andhesit',
                    'subtitle' => 'Batu alam untuk landscaping',
                    'summary' => 'Batu andesit natural untuk taman, dinding, dan sentuhan arsitektural yang estetik dan awet.',
                    'specifications' => [
                        'Jenis' => 'Andesit natural',
                        'Finish' => 'Boulder / cladding / paving',
                        'Keseragaman' => 'Warna & tekstur natural',
                        'Bentuk' => 'Custom sesuai kebutuhan',
                    ],
                    'uses' => 'Taman, cladding dinding, paving, dan elemen hardscape.',
                    'sort_order' => 6,
                ],
            ],
        ];

        foreach ($catalog[$category->name] ?? [] as $data) {
            $data['image'] = match (true) {
                $category->name === 'Beton Ready Mix' && str_contains($data['name'], 'K-175') => 'produk/mortar-foam.webp',
                $category->name === 'Beton Ready Mix' => 'hero/beton-readymix-1.jpg',
                $category->name === 'Beton Pracetak / Precast' => 'hero/precast-jkb.webp',
                default => 'kategori/split.webp',
            };

            if (! isset($data['gallery'])) {
                $data['gallery'] = match (true) {
                    $category->name === 'Beton Ready Mix' => ['hero/beton-readymix-1.jpg', 'hero/dsc-1959.webp', 'hero/dsc-0101.webp'],
                    $category->name === 'Beton Pracetak / Precast' => ['hero/precast-jkb.webp', 'hero/dsc-0101.webp', 'hero/dsc-1959.webp'],
                    default => ['kategori/split.webp', 'hero/dsc-1959.webp', 'hero/beton-readymix-1.jpg'],
                };
            }

            Product::updateOrCreate(
                ['name' => $data['name'], 'category_id' => $category->id],
                array_merge($data, ['category_id' => $category->id, 'is_active' => true])
            );
        }
    }

    private function seedProjects(): void
    {
        $projects = [
            [
                'title' => 'Pasokan Beton Perumahan Modern Semarang',
                'category' => 'Komersial & Perumahan',
                'client_name' => 'PT Graha Kencana Development',
                'location' => 'Semarang, Jawa Tengah',
                'year' => '2025',
                'description' => 'Pasokan <strong>ready mix K-225 dan K-275</strong> untuk pembangunan 3 klaster perumahan modern seluas ± 12 hektar, mencakup pondasi, kolom, balok, dan pelat lantai.',
                'featured_image' => 'hero/dsc-1959.webp',
                'gallery' => ['hero/beton-readymix-1.jpg', 'hero/dsc-0101.webp', 'hero/dsc-1959.webp'],
            ],
            [
                'title' => 'Pasokan Beton Gedung Ruko dan Mall Ungaran',
                'category' => 'Komersial & Perumahan',
                'client_name' => 'PT Pusat Niaga Jateng',
                'location' => 'Ungaran, Kab. Semarang',
                'year' => '2025',
                'description' => 'Pemasokan <strong>ready mix K-300 dan K-350</strong> untuk struktur gedung ruko tiga lantai serta kompleks pertokoan.',
                'featured_image' => 'hero/beton-readymix-1.jpg',
                'gallery' => ['hero/dsc-1959.webp', 'hero/precast-jkb.webp', 'hero/beton-readymix-1.jpg'],
            ],
            [
                'title' => 'Struktur Pabrik dan Gudang Salatiga',
                'category' => 'Industri',
                'client_name' => 'PT Industri Manufaktur Jateng',
                'location' => 'Salatiga, Jawa Tengah',
                'year' => '2024',
                'description' => 'Kemitraan penyediaan <strong>precast balok dan beton K-400</strong> untuk pembangunan pabrik dan gudang industri seluas ± 5.000 m².',
                'featured_image' => 'hero/precast-jkb.webp',
                'gallery' => ['hero/dsc-1959.webp', 'hero/dsc-0101.webp', 'hero/precast-jkb.webp'],
            ],
            [
                'title' => 'Pra-cetak Saluran Industri Batang',
                'category' => 'Industri',
                'client_name' => 'PT Kencana Sarana Industri',
                'location' => 'Batang, Jawa Tengah',
                'year' => '2024',
                'description' => 'Penyediaan <strong>U-ditch dan box culvert precast</strong> untuk saluran drainase kawasan industri Batang.',
                'featured_image' => 'hero/dsc-0101.webp',
                'gallery' => ['hero/precast-jkb.webp', 'kategori/split.webp', 'hero/dsc-0101.webp'],
            ],
            [
                'title' => 'Betonisasi Ruas Jalan Pemalang – Comal',
                'category' => 'Infrastruktur',
                'client_name' => 'Dinas PU Bina Marga',
                'location' => 'Pemalang, Jawa Tengah',
                'year' => '2024',
                'description' => 'Pengerjaan <strong>betonisasi ruas jalan</strong> sepanjang ± 4 km dengan mutu K-350 untuk ketahanan jalan terhadap beban kendaraan berat.',
                'featured_image' => 'hero/beton-readymix-1.jpg',
                'gallery' => ['kategori/split.webp', 'hero/dsc-1959.webp', 'hero/beton-readymix-1.jpg'],
            ],
            [
                'title' => 'Gorong-gorong Jalan Tol Semarang – Batang',
                'category' => 'Infrastruktur',
                'client_name' => 'PT Tol Kencana Semarang',
                'location' => 'Semarang – Batang',
                'year' => '2023',
                'description' => 'Penyediaan <strong>box culvert dan precast</strong> untuk jembatan dan drainase sisi jalan tol ruas Semarang – Batang.',
                'featured_image' => 'hero/precast-jkb.webp',
                'gallery' => ['hero/dsc-0101.webp', 'hero/dsc-1959.webp', 'hero/precast-jkb.webp'],
            ],
        ];

        foreach ($projects as $data) {
            Project::updateOrCreate(
                ['title' => $data['title']],
                array_merge($data, ['is_active' => true, 'is_featured' => true])
            );
        }
    }

    private function seedBranches(): void
    {
        $branches = [
            [
                'name' => 'Kantor Pusat Ungaran',
                'type' => 'Cabang',
                'address' => 'Jl. Jur. PTP XVIII Jl. PTP Ngobo No.KM 2, Krajan Wringin Putih, Karangjati, Bergas, Kabupaten Semarang, Jawa Tengah',
                'phone' => '(024) 1234 5678',
                'whatsapp' => '08123456789',
                'email' => 'info@jkb.co.id',
                'operational_hours' => 'Senin – Sabtu, 07.00 – 17.00 WIB',
                'latitude' => -7.1766,
                'longitude' => 110.4250,
                'sort_order' => 1,
            ],
            [
                'name' => 'Cabang Semarang',
                'type' => 'Cabang',
                'address' => 'Kawasan Industri Cipta, Jl. Arteri Utara Jl. Yos Sudarso No.11 Blok 10, Bandarharjo, Kec. Semarang Utara, Kota Semarang, Jawa Tengah',
                'phone' => '(024) 358 900',
                'whatsapp' => '08123456002',
                'email' => 'semarang@jkb.co.id',
                'operational_hours' => 'Senin – Sabtu, 08.00 – 16.00 WIB',
                'latitude' => -6.9524,
                'longitude' => 110.4212,
                'sort_order' => 2,
            ],
            [
                'name' => 'Cabang Batang',
                'type' => 'Cabang',
                'address' => 'Jl. Raya Tragung, Kec. Kandeman, Kabupaten Batang, Jawa Tengah',
                'phone' => '(0285) 391 778',
                'whatsapp' => '08123456003',
                'email' => 'batang@jkb.co.id',
                'operational_hours' => 'Senin – Sabtu, 08.00 – 16.00 WIB',
                'latitude' => -6.9396,
                'longitude' => 109.7592,
                'sort_order' => 3,
            ],
            [
                'name' => 'Cabang Purwokerto',
                'type' => 'Cabang',
                'address' => 'Jl. Jenderal Gatot Subroto, RT.07/RW.04, Dusun III, Kaliori, Kec. Kalibagor, Kabupaten Banyumas, Jawa Tengah',
                'phone' => '(0281) 555 100',
                'whatsapp' => '08123456004',
                'email' => 'purwokerto@jkb.co.id',
                'operational_hours' => 'Senin – Sabtu, 08.00 – 16.00 WIB',
                'latitude' => -7.5003,
                'longitude' => 109.2911,
                'sort_order' => 4,
            ],
            [
                'name' => 'Satellite Muntilan',
                'type' => 'Satellite',
                'address' => 'Seloining, Jumoyo, Kec. Salam, Kabupaten Magelang, Jawa Tengah',
                'phone' => '(0293) 555 200',
                'whatsapp' => '08123456005',
                'email' => 'muntilan@jkb.co.id',
                'operational_hours' => 'Senin – Sabtu, 08.00 – 16.00 WIB',
                'latitude' => -7.6106,
                'longitude' => 110.3103,
                'sort_order' => 5,
            ],
            [
                'name' => 'KITB Krengseng',
                'type' => 'Cabang',
                'address' => 'Jl. Raya Krengseng, Rejosari, Lebo, Kec. Gringsing, Kabupaten Batang, Jawa Tengah',
                'phone' => '(0285) 555 300',
                'whatsapp' => '08123456006',
                'email' => 'kitb@jkb.co.id',
                'operational_hours' => 'Senin – Sabtu, 08.00 – 16.00 WIB',
                'latitude' => -6.9503,
                'longitude' => 110.0261,
                'sort_order' => 6,
            ],
        ];

        foreach ($branches as $data) {
            Branch::updateOrCreate(
                ['name' => $data['name']],
                array_merge($data, ['is_active' => true])
            );
        }

        Branch::whereNotIn('name', array_column($branches, 'name'))
            ->update(['is_active' => false]);
    }

    private function seedClientsAndTestimonials(): void
    {
        $clients = [
            ['name' => 'PT Superindo', 'logo' => 'klien/superindo.png'],
            ['name' => 'PT Cimory', 'logo' => 'klien/cimory.png'],
            ['name' => 'PT Matahari Putra Prima', 'logo' => 'klien/matahari.png'],
            ['name' => 'PT Indonesia Power', 'logo' => 'klien/indonesia-power.png'],
            ['name' => 'PT Pelindo', 'logo' => 'klien/pelindo.png'],
            ['name' => 'Universitas Negeri Semarang (UNNES)', 'logo' => 'klien/unnes.png'],
            ['name' => 'Universitas Diponegoro (UNDIP)', 'logo' => 'klien/undip.png'],
            ['name' => 'BINUS University', 'logo' => 'klien/binus.png'],
            ['name' => 'PT Wijaya Karya (WIKA)', 'logo' => 'klien/wika.png'],
            ['name' => 'PT Adhi Karya', 'logo' => 'klien/adhi1.png'],
            ['name' => 'PT Pertamina', 'logo' => 'klien/pertamnina.png'],
            ['name' => 'PT Sidomuncul', 'logo' => 'klien/sidomuncul.png'],
        ];

        foreach ($clients as $i => $client) {
            Client::updateOrCreate(
                ['name' => $client['name']],
                ['logo' => $client['logo'], 'sort_order' => $i + 1, 'is_active' => true]
            );
        }

        $testimonials = [
            [
                'client_name' => 'Budi Santoso',
                'company' => 'PT Graha Kencana Development',
                'position' => 'Direktur',
                'content' => 'Pasokan beton JKB selalu konsisten kualitasnya dan tepat waktu. Sangat membantu kelancaran proyek perumahan kami di Semarang.',
                'rating' => 5,
                'image' => 'klien/testimoni-petropack.webp',
                'sort_order' => 1,
            ],
            [
                'client_name' => 'Rini Wulandari',
                'company' => 'Dinas PU Bina Marga',
                'position' => 'Pejabat Pembuat Komitmen',
                'content' => 'Kualitas beton untuk betonisasi ruas jalan sangat baik dan hasil uji lab selalu memenuhi spesifikasi. Tim teknis JKB juga sigap.',
                'rating' => 5,
                'sort_order' => 2,
            ],
            [
                'client_name' => 'Andi Prasetyo',
                'company' => 'PT Industri Manufaktur Jateng',
                'position' => 'Project Manager',
                'content' => 'Produk precast JKB rapi dan toleransinya presisi, mempercepat pemasangan di lapangan. Harga terbilang kompetitif.',
                'rating' => 4,
                'sort_order' => 3,
            ],
            [
                'client_name' => 'Dewi Lestari',
                'company' => 'CV Mitra Konstruksi',
                'position' => 'Owner',
                'content' => 'Sejak 2022 kami selalu memesan material split ke JKB. Ukuran konsisten dan kadar lempungnya rendah, jarang ada komplain.',
                'rating' => 5,
                'sort_order' => 4,
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::updateOrCreate(
                ['client_name' => $data['client_name']],
                array_merge($data, ['is_active' => true])
            );
        }
    }

    private function seedNews(): void
    {
        $news = [
            [
                'title' => 'JKB Perluas Kapasitas Produksi Pracetak di Boyolali',
                'category' => 'Perusahaan',
                'excerpt' => 'Investasi lini produksi baru untuk memenuhi permintaan box culvert dan balok precast yang terus meningkat.',
                'body' => '<p><strong>Boyolali</strong> — CV Jati Kencana Beton (JKB) merampungkan perluasan pabrik pracetak di Boyolali pada awal tahun ini. Perluasan mencakup lini produksi baru untuk <em>box culvert</em>, balok precast, dan kanstin dengan kapasitas meningkat hingga 40%.</p><p>Direktur operasional JKB menyampaikan bahwa perluasan ini merupakan respons atas meningkatnya kebutuhan infrastruktur di wilayah Jawa Tengah bagian selatan dan timur.</p><p>Dengan perluasan ini, waktu produksi untuk pesanan balok jembatan dapat dipersingkat menjadi 10-14 hari setelah proses desain.</p>',
                'author' => 'Tim Humas JKB',
                'published_at' => now()->subDays(4)->startOfDay(),
                'views' => 303,
                'image' => 'hero/precast-jkb.webp',
            ],
            [
                'title' => 'Sistem Pemantauan Armada Truk Mixer Berjalan Optimal',
                'category' => 'Teknologi',
                'excerpt' => 'Seluruh truk mixer JKB terintegrasi GPS untuk memastikan slump beton tetap konsisten saat tiba di lokasi.',
                'body' => '<p>JKB memberlakukan sistem pemantauan armada berbasis GPS pada seluruh truk mixer. Setiap kiriman dilacak secara real-time dari batching plant hingga titik tuang.</p><p>Pemantauan ini memastikan waktu tempuh terkendali sehingga kualitas beton — terutama nilai <em>slump</em> — tetap berada dalam toleransi saat sampai di proyek.</p><p>Pelanggan juga memperoleh informasi estimasi waktu kedatangan melalui koordinasi tim operator kami.</p>',
                'author' => 'Tim QA/QC JKB',
                'published_at' => now()->subWeeks(2)->startOfDay(),
                'views' => 150,
                'image' => 'hero/beton-readymix-1.jpg',
            ],
            [
                'title' => 'JKB Dukung Program Betonisasi Jalan Antar-Desa',
                'category' => 'CSR & Proyek',
                'excerpt' => 'Menjadi mitra penyedia beton bagi program perbaikan jalan desa aliansi pemerintah kabupaten.',
                'body' => '<p>JKB turut berpartisipasi menjadi mitra penyedia beton pada program betonisasi jalan antar-desa yang digagas pemerintah kabupaten di Jawa Tengah.</p><p>Beton mutu K-225 dan K-275 dikirim untuk ruas jalan sepanjang total lebih dari 6 km tersebar di beberapa desa.</p><p>Kami berharap dukungan ini turut memperlancar mobilitas warga dan distribusi hasil pertanian dari desa.</p>',
                'author' => 'Tim Humas JKB',
                'published_at' => now()->subMonth()->startOfDay(),
                'views' => 98,
                'image' => 'hero/dsc-0101.webp',
            ],
        ];

        foreach ($news as $data) {
            News::updateOrCreate(
                ['title' => $data['title']],
                array_merge($data, ['is_active' => true])
            );
        }
    }

    private function seedCareers(): void
    {
        $careers = [
            [
                'title' => 'Quality Control (QC) Beton',
                'type' => 'Full-time',
                'location' => 'Ungaran, Kab. Semarang',
                'description' => 'Bertanggung jawab atas pengujian mutu material dan beton segar di laboratorium serta pemantauan kualitas di lapangan.',
                'requirements' => [
                    'Min. D3/S1 Teknik Sipil atau Teknik Kimia',
                    'Memahami mix design dan pengujian beton (slump, kuat tekan)',
                    'Teliti, disiplin, dan mampu bekerja dalam tim',
                    'Bersedia ditempatkan di batching plant',
                ],
                'application_deadline' => now()->addWeeks(3)->toDateString(),
            ],
            [
                'title' => 'Operator Batching Plant',
                'type' => 'Full-time',
                'location' => 'Boyolali, Jawa Tengah',
                'description' => 'Mengoperasikan panel batching plant sesuai job mix dan menjaga konsistensi produksi harian.',
                'requirements' => [
                    'Min. SMA/SMK sederajat',
                    'Pengalaman mín. 2 tahun sebagai operator batching plant',
                    'Memahami sistem komputerisasi batching',
                    'Siap bekerja dengan sistem shift',
                ],
                'application_deadline' => now()->addWeeks(4)->toDateString(),
            ],
            [
                'title' => 'Admin Marketing',
                'type' => 'Full-time',
                'location' => 'Semarang, Jawa Tengah',
                'description' => 'Mendukung tim pemasaran dalam pengelolaan penawaran, administrasi kontrak, dan layanan pelanggan.',
                'requirements' => [
                    'Min. D3 Administrasi/Sekretaris atau sederajat',
                    'Mahir Microsoft Office',
                    'Aktif berkomunikasi & berpenampilan profesional',
                    'Prioritas berpengalaman di bidang konstruksi',
                ],
                'application_deadline' => now()->addWeeks(2)->toDateString(),
            ],
        ];

        foreach ($careers as $data) {
            Career::updateOrCreate(
                ['title' => $data['title']],
                array_merge($data, ['is_active' => true])
            );
        }
    }

    private function seedTahukahAnda(): void
    {
        $items = [
            [
                'title' => 'Kenapa Waktu Pengiriman Beton Sangat Diperhitungkan?',
                'description' => 'Beton segar mulai mengeras dalam beberapa jam. Itulah mengapa ketepatan waktu pengiriman menentukan kualitas hasil akhir coran.',
                'content' => '<p>Beton adalah material yang &ldquo;hidup&rdquo; — setelah semen tercampur air, reaksi hidrasi langsung berjalan. Umumnya beton mulai kehilangan kelecakan (workability) dalam 90-120 menit.</p><p>Karena itu JKB membekali seluruh truk mixer dengan pemantauan GPS dan mengatur jarak serta waktu tempuh ke lokasi proyek. Jika proyek Anda jauh dari batching plant, tim kami akan merekomendasikan penyesuaian mix design atau penggunaan admixture yang memperlambat pengikatan, sehingga mutu tetap terjaga saat sampai di titik tuang.</p>',
                'published_at' => now()->subDays(3)->startOfDay(),
                'image' => 'produk/mortar-foam.webp',
            ],
            [
                'title' => 'Apa Bedanya Beton Ready Mix dan Cor Konvensional?',
                'description' => 'Gambaran singkat perbedaan mutu, efisiensi, dan biaya antara beton siap pakai pabrik dengan pengecoran manual di lapangan.',
                'content' => '<p><strong>Ready mix</strong> diproduksi di batching plant dengan takaran (mix design) terkontrol dan peralatan laboratorium, sehingga mutunya konsisten dan cepat. Sementara <strong>cor konvensional</strong> mencampur material di lapangan — biayanya bisa lebih murah untuk volume kecil, tetapi lebih rentan terhadap variasi kualitas dan membutuhkan tenaga kerja lebih banyak.</p><p>Untuk proyek dengan volume sedang hingga besar, ready mix umumnya lebih efisien karena pengiriman terbundel dalam truk mixer secara berkesinambungan.</p>',
                'published_at' => now()->subWeeks(2)->startOfDay(),
                'image' => 'hero/beton-readymix-1.jpg',
            ],
            [
                'title' => 'Tips Merencanakan Pemasangan Box Culvert',
                'description' => 'Beberapa hal yang perlu disiapkan sebelum memasang gorong-gorong pracetak agar cepat dan tepat.',
                'content' => '<p>Pemasangan box culvert yang benar dimulai dari menyiapkan dasar galian yang rata dan padat dengan lapisan pasir, lalu menurunkan unit dengan alat berat sesuai titik pemasangan.</p><p>Pastikan sambungan antar unit menggunakan gasket karet sesuai panduan agar kedap air. Jangan lupa memeriksa kelurusan dan elevasi memakai teodolit sebelum menimbun kembali.</p>',
                'published_at' => now()->subWeeks(4)->startOfDay(),
                'image' => 'hero/precast-jkb.webp',
            ],
        ];

        foreach ($items as $data) {
            $data['subtitle'] = $data['description'];

            TahukahAnda::updateOrCreate(
                ['title' => $data['title']],
                array_merge($data, ['is_active' => true])
            );
        }
    }
}