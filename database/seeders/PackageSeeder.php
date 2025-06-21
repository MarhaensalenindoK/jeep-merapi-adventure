<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\PackageCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua kategori dan user
        $categories = PackageCategory::all();
        $users = User::all();

        if ($categories->isEmpty()) {
            $this->command->warn('No categories found. Please run PackageCategorySeeder first.');
            return;
        }

        if ($users->isEmpty()) {
            $this->command->warn('No users found. Please create users first.');
            return;
        }

        // Data sample packages
        $packages = [
            [
                'name' => 'Sunrise Merapi Adventure',
                'price' => 350000,
                'duration' => '1 Hari',
                'routes' => "Jalur yang akan dilalui:\n- Start: Basecamp Kaliurang\n- Pos 1: Gardu Pandang\n- Pos 2: Pasar Bubrah\n- Pos 3: Puncak Merapi\n- Turun via jalur yang sama\n- Finish: Basecamp Kaliurang",
                'full_description' => "Paket wisata sunrise untuk melihat matahari terbit dari puncak Merapi. Perjalanan dimulai dini hari sekitar pukul 02.00 WIB dengan trekking selama 4-5 jam menuju puncak. Pemandangan sunrise dari ketinggian akan memberikan pengalaman tak terlupakan.\n\nFasilitas:\n- Transportasi PP dari Yogyakarta\n- Guide profesional\n- Headlamp dan alat safety\n- Sarapan ringan\n- Dokumentasi"
            ],
            [
                'name' => 'Lava Tour Merapi Ekstrem',
                'price' => 450000,
                'duration' => '6 Jam',
                'routes' => "Rute perjalanan:\n- Penjemputan di hotel\n- Bunker Kaliadem\n- Sisa Rumah Mbah Maridjan\n- Museum Sisa Hartaku\n- Alien Stone\n- Kali Kuning (River Tubing)\n- Jembatan Gantung\n- Kembali ke hotel",
                'full_description' => "Menyaksikan jejak dahsyatnya letusan Merapi 2010 dengan jeep offroad. Mengunjungi lokasi-lokasi bersejarah yang terdampak erupsi dan melihat bagaimana alam pulih kembali. Dilengkapi dengan aktivitas river tubing di Kali Kuning.\n\nHighlight:\n- Offroad jeep adventure\n- Wisata edukasi gunung berapi\n- River tubing seru\n- Foto di spot instagramable\n- Guide lokal berpengalaman"
            ],
            [
                'name' => 'Camping Merapi Under Stars',
                'price' => 650000,
                'duration' => '2 Hari 1 Malam',
                'routes' => "Itinerary camping:\nHari 1:\n- Check-in basecamp (14.00)\n- Setup tenda\n- Trekking sore ke pos 2\n- Makan malam\n- Stargazing\n\nHari 2:\n- Sunrise hunting\n- Sarapan\n- Packing\n- Check-out (10.00)",
                'full_description' => "Pengalaman menginap di lereng Merapi dengan suasana alam yang tenang. Menikmati langit malam berbintang, sunrise, dan udara segar pegunungan. Cocok untuk yang ingin merasakan petualangan camping dengan fasilitas lengkap.\n\nInclude:\n- Tenda dan sleeping bag\n- Meals (dinner & breakfast)\n- Campfire session\n- Stargazing equipment\n- Professional guide\n- Safety equipment"
            ],
            [
                'name' => 'Merapi Heritage Walk',
                'price' => 275000,
                'duration' => '4 Jam',
                'routes' => "Rute walking tour:\n- Desa Kepuharjo\n- Makam Mbah Maridjan\n- Rumah tradisional Jawa\n- Kebun salak Yogyakarta\n- Spot foto instagramable\n- Warung tradisional\n- Museum mini Merapi",
                'full_description' => "Wisata budaya mengenal kehidupan masyarakat lereng Merapi. Belajar tentang kearifan lokal, tradisi, dan bagaimana masyarakat hidup berdampingan dengan gunung berapi. Termasuk kuliner tradisional dan oleh-oleh khas.\n\nAktivitas:\n- Village tour\n- Interaksi dengan penduduk lokal\n- Kuliner tradisional\n- Workshop kerajinan\n- Shopping oleh-oleh"
            ],
            [
                'name' => 'Merapi Extreme Hiking',
                'price' => 850000,
                'duration' => '3 Hari 2 Malam',
                'routes' => "Rute hiking ekstrem:\nHari 1: Basecamp - Pos 3 (camping)\nHari 2: Pos 3 - Puncak - Pos 2 (camping)\nHari 3: Pos 2 - Basecamp\n\nMelalui jalur:\n- Kaliurang route\n- Selo route alternative\n- River crossing\n- Rock climbing section",
                'full_description' => "Paket untuk pendaki berpengalaman yang ingin tantangan lebih. Mendaki via jalur ekstrem dengan bivak 2 malam di gunung. Pemandangan 360 derajat dari puncak dan pengalaman survival yang menantang.\n\nRequirement:\n- Pengalaman hiking minimal 2 tahun\n- Fisik prima\n- Peralatan lengkap\n- Medical check-up\n\nFacilities:\n- Professional mountain guide\n- Emergency equipment\n- Satellite communication\n- Insurance coverage"
            ],
            [
                'name' => 'Family Merapi Easy Trek',
                'price' => 185000,
                'duration' => '3 Jam',
                'routes' => "Jalur ramah keluarga:\n- Start: Taman Nasional Merapi\n- Pos Pengamatan 1\n- Spot foto keluarga\n- Picnic area\n- Educational center\n- Playground area\n- Finish: Taman Nasional",
                'full_description' => "Paket wisata keluarga dengan anak-anak untuk mengenal Merapi dengan mudah dan aman. Jalur pendek dengan fasilitas lengkap, educational center, dan area bermain anak.\n\nFasilitas keluarga:\n- Kid-friendly trail\n- Safety equipment for children\n- Educational games\n- Family photo session\n- Healthy snacks\n- Clean restroom facilities"
            ],
            [
                'name' => 'Merapi Photography Tour',
                'price' => 425000,
                'duration' => '8 Jam',
                'routes' => "Spot foto terbaik:\n- Golden hour di Kaliurang\n- Sunrise point Merapi\n- Lava flow area\n- Traditional village\n- Scenic overlook\n- Sunset di Tlogo Putri\n- Blue hour photography",
                'full_description' => "Khusus untuk fotografer dan pecinta fotografi. Mengunjungi spot-spot terbaik untuk mendapatkan foto landscape, portrait, dan dokumenter dengan guidance dari fotografer profesional.\n\nInclude:\n- Professional photographer guide\n- Photography workshop\n- Best spot locations\n- Editing tips\n- Print voucher\n- Portfolio review"
            ],
            [
                'name' => 'Merapi Spiritual Journey',
                'price' => 550000,
                'duration' => '2 Hari 1 Malam',
                'routes' => "Perjalanan spiritual:\n- Makam Kyai Merapi\n- Meditasi di Pos 2\n- Ritual tradisional Jawa\n- Pemandian suci\n- Makam para sesepuh\n- Tirakat malam\n- Sunrise prayer",
                'full_description' => "Wisata spiritual untuk mengenal sisi mistis dan sakral Gunung Merapi. Dipandu oleh sesepuh local yang memahami tradisi dan ritual Jawa. Pengalaman mendalam tentang hubungan manusia dengan alam.\n\nSpiritual activities:\n- Traditional Javanese ceremony\n- Meditation session\n- Sacred bath ritual\n- Night vigil\n- Spiritual counseling\n- Local wisdom sharing"
            ],
            [
                'name' => 'Merapi Research Study Tour',
                'price' => 325000,
                'duration' => '5 Jam',
                'routes' => "Rute edukatif:\n- BPPTKG (Seismology Center)\n- Museum Gunungapi Merapi\n- Observation post\n- Research station\n- Geology field study\n- Laboratory visit\n- Data analysis center",
                'full_description' => "Program edukasi untuk pelajar dan mahasiswa geologi, geografi, atau volkanologi. Belajar langsung dari para ahli tentang aktivitas gunung berapi, sistem peringatan dini, dan mitigasi bencana.\n\nEducational content:\n- Volcano monitoring system\n- Seismic data interpretation\n- Hazard mapping\n- Early warning system\n- Community preparedness\n- Research methodology"
            ],
            [
                'name' => 'Merapi Culinary Trail',
                'price' => 195000,
                'duration' => '4 Jam',
                'routes' => "Jalur kuliner:\n- Pasar tradisional Kaliurang\n- Warung gudeg Merapi\n- Kebun salak organik\n- Industri kripik tempe\n- Sentra kerajinan bambu\n- Kedai kopi lereng Merapi\n- Toko oleh-oleh",
                'full_description' => "Menjelajahi kuliner khas lereng Merapi sambil belajar tentang produk lokal dan industri kreatif masyarakat. Mencicipi makanan tradisional dan membeli oleh-oleh langsung dari produsen.\n\nCulinary highlights:\n- Traditional Javanese cuisine\n- Fresh local produce\n- Home-made snacks\n- Organic farming visit\n- Cooking demonstration\n- Local craft shopping"
            ]
        ];

        $this->command->info('Creating ' . count($packages) . ' sample packages...');

        foreach ($packages as $index => $packageData) {
            // Random category and user
            $category = $categories->random();
            $user = $users->random();

            Package::create([
                'package_category_id' => $category->id,
                'name' => $packageData['name'],
                'slug' => Str::slug($packageData['name']),
                'price' => $packageData['price'],
                'duration' => $packageData['duration'],
                'routes' => $packageData['routes'],
                'full_description' => $packageData['full_description'],
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now()->subDays(rand(0, 15)),
            ]);

            $this->command->info('Created: ' . $packageData['name']);
        }

        // Tambahkan beberapa packages untuk testing pagination
        $this->command->info('Adding additional packages for pagination testing...');

        for ($i = 1; $i <= 25; $i++) {
            $category = $categories->random();
            $user = $users->random();

            $prices = [150000, 250000, 350000, 450000, 550000, 650000, 750000, 850000];
            $durations = ['1 Hari', '2 Hari 1 Malam', '3 Hari 2 Malam', '4 Jam', '6 Jam', '8 Jam'];

            Package::create([
                'package_category_id' => $category->id,
                'name' => 'Paket Merapi Adventure ' . $i,
                'slug' => Str::slug('Paket Merapi Adventure ' . $i),
                'price' => $prices[array_rand($prices)],
                'duration' => $durations[array_rand($durations)],
                'routes' => "Rute perjalanan untuk paket adventure " . $i . ":\n- Basecamp start\n- Checkpoint 1\n- Checkpoint 2\n- Destination point\n- Return journey",
                'full_description' => "Deskripsi lengkap untuk paket adventure " . $i . ". Paket ini dirancang khusus untuk memberikan pengalaman terbaik dalam menjelajahi Gunung Merapi dengan berbagai aktivitas menarik dan fasilitas lengkap.\n\nFasilitas include:\n- Transportation\n- Professional guide\n- Safety equipment\n- Meals\n- Documentation",
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'created_at' => now()->subDays(rand(1, 60)),
                'updated_at' => now()->subDays(rand(0, 30)),
            ]);
        }

        $this->command->info('Package seeder completed successfully!');
        $this->command->info('Total packages created: ' . Package::count());
    }
}
