<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gallery;
use App\Models\Package;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some packages to associate with galleries
        $packages = Package::all();

        if ($packages->isEmpty()) {
            $this->command->info('No packages found. Creating galleries without package association.');
        }

        $galleries = [
            [
                'title' => 'Pemandangan Gunung Merapi',
                'description' => 'Pemandangan spektakuler dari puncak Gunung Merapi saat sunrise',
                'image_path' => 'galleries/merapi-sunrise.jpg',
                'alt_text' => 'Sunrise view from Mount Merapi peak',
                'sort_order' => 1,
                'is_featured' => true,
                'package_id' => $packages->isNotEmpty() ? $packages->first()->id : null,
            ],
            [
                'title' => 'Jeep Adventure',
                'description' => 'Petualangan seru menggunakan jeep di lereng Merapi',
                'image_path' => 'galleries/jeep-adventure.jpg',
                'alt_text' => 'Jeep adventure on Merapi slopes',
                'sort_order' => 2,
                'is_featured' => true,
                'package_id' => $packages->isNotEmpty() ? $packages->first()->id : null,
            ],
            [
                'title' => 'Lava Tour',
                'description' => 'Wisata edukasi ke lokasi bekas aliran lava Merapi',
                'image_path' => 'galleries/lava-tour.jpg',
                'alt_text' => 'Educational lava tour location',
                'sort_order' => 3,
                'is_featured' => false,
                'package_id' => $packages->count() > 1 ? $packages->get(1)->id : null,
            ],
            [
                'title' => 'Sunrise Hunting',
                'description' => 'Berburu sunrise di spot terbaik Merapi',
                'image_path' => 'galleries/sunrise-hunting.jpg',
                'alt_text' => 'Sunrise hunting at Merapi best spots',
                'sort_order' => 4,
                'is_featured' => false,
                'package_id' => $packages->count() > 1 ? $packages->get(1)->id : null,
            ],
            [
                'title' => 'Desa Wisata',
                'description' => 'Kunjungan ke desa wisata sekitar Merapi',
                'image_path' => 'galleries/village-tour.jpg',
                'alt_text' => 'Village tourism around Merapi',
                'sort_order' => 5,
                'is_featured' => false,
                'package_id' => $packages->count() > 2 ? $packages->get(2)->id : null,
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }

        $this->command->info('Gallery seeder completed successfully!');
    }
}
