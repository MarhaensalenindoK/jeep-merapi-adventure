<?php

namespace Database\Seeders;

use App\Models\PackageCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PackageCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin user (atau buat user admin jika belum ada)
        $admin = User::first();

        if (!$admin) {
            $admin = User::create([
                'name' => 'Administrator',
                'email' => 'admin@jeep-merapi.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }

        // Hapus data lama untuk testing fresh (disable foreign key checks)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        PackageCategory::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Data sample categories BANYAK untuk testing pagination
        $categories = [
            [
                'name' => 'Short Trip',
                'description' => 'Paket wisata singkat untuk pengalaman cepat dan menyenangkan di sekitar Gunung Merapi. Cocok untuk pemula atau wisatawan dengan waktu terbatas.',
            ],
            [
                'name' => 'Medium Trip',
                'description' => 'Paket wisata menengah dengan eksplorasi lebih mendalam ke berbagai spot menarik di kawasan Merapi. Ideal untuk keluarga dan kelompok kecil.',
            ],
            [
                'name' => 'Long Trip',
                'description' => 'Paket wisata lengkap dengan pengalaman petualangan yang komprehensif. Menjelajahi seluruh area Merapi dengan aktivitas yang beragam.',
            ],
            [
                'name' => 'Adventure Package',
                'description' => 'Paket khusus untuk para petualang yang mencari tantangan ekstrem dengan berbagai aktivitas outdoor di kawasan Merapi.',
            ],
            [
                'name' => 'Family Package',
                'description' => 'Paket wisata yang dirancang khusus untuk keluarga dengan anak-anak. Aman, nyaman, dan edukatif.',
            ],
            [
                'name' => 'Lava Tour Classic',
                'description' => 'Tur klasik menjelajahi aliran lava kuno dengan pemandangan spektakuler dan edukasi tentang sejarah letusan Merapi.',
            ],
            [
                'name' => 'Sunrise Hunting',
                'description' => 'Berburu sunrise dengan pemandangan indah dari ketinggian Gunung Merapi. Pengalaman magis yang tak terlupakan.',
            ],
            [
                'name' => 'Sunset Adventure',
                'description' => 'Petualangan sore hari dengan pemandangan sunset yang memukau dari berbagai spot terbaik di kawasan Merapi.',
            ],
            [
                'name' => 'Photography Tour',
                'description' => 'Tur khusus untuk para fotografer dengan panduan ke spot-spot terbaik untuk mengambil foto landscape yang menakjubkan.',
            ],
            [
                'name' => 'Cultural Heritage',
                'description' => 'Wisata budaya yang menggabungkan petualangan alam dengan kekayaan budaya lokal masyarakat sekitar Merapi.',
            ],
            [
                'name' => 'Extreme Off Road',
                'description' => 'Petualangan off road ekstrem untuk para adrenalin junkie dengan rute-rute menantang di medan vulkanik.',
            ],
            [
                'name' => 'Camping Adventure',
                'description' => 'Paket camping dengan pengalaman bermalam di alam terbuka dengan pemandangan Gunung Merapi yang spektakuler.',
            ],
            [
                'name' => 'Honeymoon Package',
                'description' => 'Paket romantis untuk pasangan pengantin baru dengan suasana privat dan pemandangan yang memukau.',
            ],
            [
                'name' => 'Student Package',
                'description' => 'Paket edukasi untuk pelajar dan mahasiswa dengan harga terjangkau dan nilai pembelajaran yang tinggi.',
            ],
            [
                'name' => 'Corporate Outing',
                'description' => 'Paket khusus untuk perusahaan dengan aktivitas team building dan refreshing untuk karyawan.',
            ],
            [
                'name' => 'Team Building Special',
                'description' => 'Program team building dengan berbagai permainan dan tantangan yang mempererat kerjasama tim.',
            ],
            [
                'name' => 'Educational Tour',
                'description' => 'Tur edukatif tentang geologi, vulkanologi, dan ekosistem unik di sekitar Gunung Merapi.',
            ],
            [
                'name' => 'Volcanic Exploration',
                'description' => 'Eksplorasi mendalam tentang fenomena vulkanik dengan panduan ahli geologi dan vulkanologi.',
            ],
            [
                'name' => 'Historical Journey',
                'description' => 'Perjalanan sejarah menelusuri jejak letusan dahulu dan dampaknya terhadap kehidupan masyarakat.',
            ],
            [
                'name' => 'Nature Photography',
                'description' => 'Fokus pada fotografi alam dengan berbagai teknik dan spot terbaik untuk hasil foto yang maksimal.',
            ],
            [
                'name' => 'Bird Watching Tour',
                'description' => 'Tur khusus untuk mengamati berbagai jenis burung endemik di kawasan hutan Merapi.',
            ],
            [
                'name' => 'Eco Tourism',
                'description' => 'Wisata ramah lingkungan dengan edukasi tentang konservasi alam dan pemberdayaan masyarakat lokal.',
            ],
            [
                'name' => 'Geological Survey',
                'description' => 'Program survei geologi untuk memahami struktur dan komposisi batuan vulkanik Merapi.',
            ],
            [
                'name' => 'Research Expedition',
                'description' => 'Ekspedisi riset untuk keperluan akademik dan penelitian tentang gunung api aktif.',
            ],
            [
                'name' => 'Backpacker Package',
                'description' => 'Paket ekonomis untuk backpacker dengan fasilitas dasar namun pengalaman yang tak kalah menarik.',
            ],
            [
                'name' => 'Luxury Adventure',
                'description' => 'Petualangan mewah dengan fasilitas premium dan pelayanan VIP untuk pengalaman eksklusif.',
            ],
            [
                'name' => 'Premium Experience',
                'description' => 'Pengalaman premium dengan berbagai fasilitas terbaik dan pelayanan yang personal.',
            ],
            [
                'name' => 'Budget Friendly',
                'description' => 'Paket hemat untuk wisatawan dengan budget terbatas namun tetap mendapat pengalaman yang berkesan.',
            ],
            [
                'name' => 'Weekend Getaway',
                'description' => 'Paket liburan akhir pekan yang sempurna untuk melepas penat dari rutinitas sehari-hari.',
            ],
            [
                'name' => 'Extended Adventure',
                'description' => 'Petualangan diperpanjang dengan berbagai aktivitas dan destinasi yang lebih lengkap.',
            ],
            [
                'name' => 'Multi Day Trekking',
                'description' => 'Trekking beberapa hari dengan camping dan eksplorasi area yang lebih luas di kawasan Merapi.',
            ],
            [
                'name' => 'Single Day Trip',
                'description' => 'Perjalanan satu hari penuh dengan itinerary yang padat dan pengalaman yang maksimal.',
            ],
            [
                'name' => 'Half Day Tour',
                'description' => 'Tur setengah hari yang efisien untuk wisatawan dengan waktu terbatas.',
            ],
            [
                'name' => 'Full Day Experience',
                'description' => 'Pengalaman seharian penuh dari pagi hingga sore dengan berbagai aktivitas menarik.',
            ],
            [
                'name' => 'Custom Package',
                'description' => 'Paket yang dapat disesuaikan dengan kebutuhan dan preferensi khusus wisatawan.',
            ],
            [
                'name' => 'Private Tour',
                'description' => 'Tur privat dengan pemandu khusus untuk pengalaman yang lebih personal dan eksklusif.',
            ],
            [
                'name' => 'Group Adventure',
                'description' => 'Petualangan kelompok dengan harga spesial dan aktivitas yang cocok untuk grup besar.',
            ],
            [
                'name' => 'Solo Traveler',
                'description' => 'Paket khusus untuk solo traveler dengan keamanan terjamin dan komunitas yang ramah.',
            ],
            [
                'name' => 'International Tourist',
                'description' => 'Paket untuk wisatawan mancanegara dengan guide berbahasa Inggris dan layanan internasional.',
            ],
            [
                'name' => 'Domestic Tourist',
                'description' => 'Paket untuk wisatawan domestik dengan pemahaman budaya lokal yang mendalam.',
            ],
            [
                'name' => 'Special Occasion',
                'description' => 'Paket untuk acara khusus seperti ulang tahun, anniversary, atau perayaan lainnya.',
            ],
            [
                'name' => 'Anniversary Package',
                'description' => 'Paket romantis untuk merayakan anniversary dengan suasana yang istimewa dan berkesan.',
            ],
            [
                'name' => 'Birthday Adventure',
                'description' => 'Petualangan ulang tahun yang tak terlupakan dengan kejutan dan pengalaman spesial.',
            ],
            [
                'name' => 'Graduation Trip',
                'description' => 'Perjalanan wisuda untuk merayakan kelulusan dengan teman-teman dan kenangan indah.',
            ],
            [
                'name' => 'Holiday Special',
                'description' => 'Paket liburan spesial dengan promo menarik dan pengalaman yang berkesan.',
            ],
            [
                'name' => 'Seasonal Package',
                'description' => 'Paket musiman yang disesuaikan dengan kondisi cuaca dan aktivitas terbaik di setiap musim.',
            ],
            [
                'name' => 'Rainy Season Tour',
                'description' => 'Tur khusus musim hujan dengan aktivitas indoor dan spot yang tetap menarik saat hujan.',
            ],
            [
                'name' => 'Dry Season Adventure',
                'description' => 'Petualangan musim kemarau dengan aktivitas outdoor maksimal dan cuaca yang mendukung.',
            ],
            [
                'name' => 'Festival Package',
                'description' => 'Paket festival dengan pengalaman budaya lokal dan perayaan tradisional masyarakat Merapi.',
            ],
            [
                'name' => 'Local Culture Tour',
                'description' => 'Tur budaya lokal untuk mengenal kehidupan dan tradisi masyarakat sekitar Gunung Merapi.',
            ],
            [
                'name' => 'Traditional Experience',
                'description' => 'Pengalaman tradisional dengan aktivitas autentik dan interaksi langsung dengan budaya lokal.',
            ]
        ];

        foreach ($categories as $index => $categoryData) {
            PackageCategory::create([
                'name' => $categoryData['name'],
                'slug' => Str::slug($categoryData['name']),
                'description' => $categoryData['description'],
                'created_by' => $admin->id,
                'updated_by' => $admin->id,
                'created_at' => now()->subDays(rand(1, 365)), // Random tanggal dalam setahun terakhir
                'updated_at' => now()->subDays(rand(0, 30)),  // Random update dalam 30 hari terakhir
            ]);
        }

        $this->command->info('✅ Berhasil membuat ' . count($categories) . ' kategori untuk testing pagination!');
    }
}
