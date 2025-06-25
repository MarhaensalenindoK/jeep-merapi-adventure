<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Get admin user or create one
        $admin = User::first() ?? User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        $posts = [
            [
                'title' => 'Petualangan Menakjubkan di Gunung Merapi',
                'slug' => 'petualangan-menakjubkan-di-gunung-merapi',
                'body' => 'Gunung Merapi merupakan salah satu destinasi wisata alam yang paling menarik di Yogyakarta. Dengan keindahan alam yang memukau dan pengalaman yang tak terlupakan, Merapi menawarkan berbagai aktivitas seru mulai dari sunrise tour hingga lava tour yang menantang adrenalin.

Dalam artikel ini, kami akan membahas berbagai hal menarik yang bisa Anda temukan saat berkunjung ke Gunung Merapi. Mulai dari persiapan yang diperlukan, jalur-jalur trekking yang tersedia, hingga tips keselamatan yang penting untuk diketahui.

Gunung Merapi bukan hanya sekedar destinasi wisata biasa. Ia adalah saksi bisu sejarah dan kekuatan alam yang luar biasa. Dengan ketinggian 2.930 meter di atas permukaan laut, Merapi menawarkan pemandangan yang spektakuler terutama saat matahari terbit.

Untuk mendapatkan pengalaman terbaik, disarankan untuk menggunakan jasa tour guide yang berpengalaman dan mengikuti jalur-jalur resmi yang telah ditentukan.',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Tips Keselamatan Saat Jeep Tour Merapi',
                'slug' => 'tips-keselamatan-saat-jeep-tour-merapi',
                'body' => 'Keselamatan adalah prioritas utama saat melakukan jeep tour di kawasan Gunung Merapi. Sebagai gunung berapi aktif, Merapi memiliki karakteristik terrain yang menantang dan kondisi cuaca yang dapat berubah dengan cepat.

Berikut adalah beberapa tips penting yang perlu Anda perhatikan:

1. **Gunakan Perlengkapan yang Tepat**
   - Pakai sepatu dengan grip yang baik
   - Bawa jaket tebal untuk menghadapi suhu dingin
   - Jangan lupa masker untuk melindungi dari debu vulkanik

2. **Pilih Operator Tour yang Terpercaya**
   - Pastikan jeep dalam kondisi baik dan terawat
   - Driver berpengalaman dan mengenal medan
   - Tersedia asuransi perjalanan

3. **Perhatikan Kondisi Cuaca**
   - Hindari tour saat cuaca buruk
   - Cek status aktivitas vulkanik terkini
   - Ikuti arahan dari guide sepanjang perjalanan

Dengan mengikuti tips-tips di atas, pengalaman jeep tour Anda akan menjadi lebih aman dan menyenangkan.',
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Wisata Kuliner Khas Lereng Merapi',
                'slug' => 'wisata-kuliner-khas-lereng-merapi',
                'body' => 'Selain keindahan alamnya, kawasan lereng Gunung Merapi juga menawarkan berbagai kuliner khas yang sayang untuk dilewatkan. Makanan-makanan tradisional dengan cita rasa autentik menjadi daya tarik tersendiri bagi para wisatawan.

**Kuliner Wajib Coba:**

1. **Gudeg Merapi**
   Gudeg dengan cita rasa khas yang berbeda dari gudeg Yogyakarta pada umumnya. Dimasak dengan kayu bakar dan bumbu tradisional.

2. **Sate Klathak**
   Sate kambing muda yang dipanggang dengan cara tradisional menggunakan arang kayu. Dagingnya empuk dan bumbunya meresap sempurna.

3. **Wedang Uwuh**
   Minuman tradisional hangat yang cocok dinikmati di udara sejuk lereng Merapi. Terbuat dari campuran rempah-rempah pilihan.

4. **Oseng Mercon**
   Sayuran oseng dengan level kepedasan yang bisa disesuaikan selera. Cocok untuk menghangatkan tubuh setelah tour.

Jangan lupa untuk mencicipi semua kuliner ini saat berkunjung ke Merapi!',
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Persiapan Fisik untuk Sunrise Tour Merapi',
                'slug' => 'persiapan-fisik-untuk-sunrise-tour-merapi',
                'body' => 'Sunrise tour Merapi adalah salah satu pengalaman yang paling dinanti para wisatawan. Namun, untuk dapat menikmatinya dengan maksimal, diperlukan persiapan fisik yang baik karena aktivitas ini cukup menantang.

**Program Persiapan Fisik:**

**2 Minggu Sebelum Tour:**
- Mulai jogging rutin minimal 30 menit setiap hari
- Latihan kardio untuk meningkatkan stamina
- Stretching untuk fleksibilitas otot

**1 Minggu Sebelum Tour:**
- Tingkatkan intensitas latihan
- Coba hiking di bukit-bukit kecil untuk adaptasi
- Istirahat yang cukup

**Hari H:**
- Sarapan ringan tapi bergizi
- Bawa air minum yang cukup
- Jangan memaksakan diri jika merasa tidak fit

**Tips Tambahan:**
- Gunakan sepatu hiking yang sudah familiar
- Bawa snack energi untuk cadangan
- Lakukan pemanasan sebelum mulai trekking

Dengan persiapan yang matang, Anda akan dapat menikmati sunrise Merapi yang spektakuler tanpa kendala berarti.',
                'published_at' => null, // Draft
            ],
            [
                'title' => 'Sejarah Letusan Gunung Merapi dan Dampaknya',
                'slug' => 'sejarah-letusan-gunung-merapi-dan-dampaknya',
                'body' => 'Gunung Merapi memiliki sejarah panjang aktivitas vulkanik yang memberikan dampak signifikan bagi kehidupan masyarakat sekitar. Memahami sejarah ini penting untuk menghargai kekuatan alam dan kearifan lokal yang berkembang.

**Letusan Bersejarah:**

**Letusan 2010**
Letusan terbesar dalam kurun waktu 100 tahun terakhir. Menghasilkan awan panas yang mencapai jarak 15 km dan menyebabkan korban jiwa serta kerusakan infrastruktur yang cukup besar.

**Letusan 1930**
Salah satu letusan yang tercatat dengan baik dalam sejarah modern. Memberikan dampak pada perubahan topografi kawasan dan pola kehidupan masyarakat.

**Dampak Positif:**
- Tanah menjadi subur karena abu vulkanik
- Terbentuknya destinasi wisata baru
- Meningkatnya kesadaran mitigasi bencana

**Dampak Negatif:**
- Kerusakan infrastruktur
- Gangguan aktivitas ekonomi
- Trauma psikologis masyarakat

Kini, kawasan Merapi telah bangkit menjadi destinasi wisata yang aman dengan sistem peringatan dini yang canggih.',
                'published_at' => now()->subDays(7),
            ],
        ];

        foreach ($posts as $postData) {
            Post::create([
                'user_id' => $admin->id,
                'title' => $postData['title'],
                'slug' => $postData['slug'],
                'body' => $postData['body'],
                'published_at' => $postData['published_at'],
                'created_by' => $admin->id,
                'updated_by' => $admin->id,
            ]);
        }
    }
}
