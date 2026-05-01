<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Dummy data video edukasi.
     * Di production, ganti dengan Model::all() atau Model::where(...)->get()
     */
    private function getVideos(): array
    {
        return [
            ['id' => 1, 'cat' => 'bayi',   'title' => 'Yuk Ibu! Cegah Anak Stunting dengan Rutin Membawa Bayi/Balita ke Posyandu', 'desc' => 'Pencegahan dari Stunting','dur' => '0:59',  'views' => '5.5rb', 'rating' => '4.9','youtube_id' => 'snHW62berwk', 'bg' => '#AAFFC7', 'emoji' => '🥣'],
            ['id' => 9, 'cat' => 'bayi',   'title' => 'ISI PIRINGKU KAYA PROTEIN HEWANI, PROTEIN HEWANI CEGAH STUNTING', 'desc' => 'Protein Hewani Cegah Stunting',   'dur' => '3:56', 'views' => '15rb', 'rating' => '4.9','youtube_id' => 'NjWdAkoZMfU',  'bg' => '#E6EEF5', 'emoji' => '👶'],
            ['id' => 4, 'cat' => 'bayi',   'title' => 'Ayo Terapkan Gizi Seimbang melalui Prinsip Isi Piringku','desc' => 'Gizi Seimbang', 'dur' => '5:40',  'views' => '42.1rb', 'rating' => '4.9','youtube_id' => '3e2SZB6zzaA', 'bg' => '#E6EEF5', 'emoji' => '🍼'],
            ['id' => 3, 'cat' => 'bayi',   'title' => 'ANIMASI EDUKASI CUCI TANGAN | PUSKESMAS WONOKARTO | DENGAN LAGU', 'desc' => 'Edukasi Mengenai Cuci tangan yang benar','dur' => '01:24',  'views' => '21rb', 'rating' => '4.9','youtube_id' => 'bh-yzGauniQ', 'bg' => '#AAFFC7', 'emoji' => '🥣'],
            ['id' => 5, 'cat' => 'bayi',   'title' => 'Ayo Cegah Stunting - Sehatpedia', 'desc' => 'Pencegahan dari Stunting','dur' => '3:12',  'views' => '734', 'rating' => '4.9','youtube_id' => 'I3zoFAVJr6I', 'bg' => '#AAFFC7', 'emoji' => '🥣'],
            ['id' => 7, 'cat' => 'bayi',   'title' => 'Yuk Kupas Tentang Stunting...!', 'desc' => 'Penjelasan Mengenai Bahaya Stunting',   'dur' => '2:22', 'views' => '102rb', 'rating' => '4.9','youtube_id' => 'ZuHRHv-_KXw',  'bg' => '#E6EEF5', 'emoji' => '👶'],
            ['id' => 8, 'cat' => 'bayi',   'title' => '[TUGAS AKHIR-SKRIPSI] Video Edukasi Pencegahan Obesitas pada Anak Sekolah Dasar','desc' => 'Edukasi Mengenai Pencegahan Obesitas', 'dur' => '5:35',  'views' => '5.2rb', 'rating' => '4.9','youtube_id' => 'VLJrshSEdTA', 'bg' => '#E6EEF5', 'emoji' => '🍼'],
            ['id' => 10, 'cat' => 'bayi',   'title' => 'Gizi Buruk dan Nutrisi', 'desc' => 'Edukasi Mengenai Gizi yang Buruk','dur' => '3:35',  'views' => '30rb', 'rating' => '4.9','youtube_id' => 'OgmFQ3yGJXM', 'bg' => '#AAFFC7', 'emoji' => '🥣'],


            ['id' => 2, 'cat' => 'anak',   'title' => 'Bubur Ganepo dengan Maxi Gudetama', 'desc' => 'MENU BUBUR SINGKONG', 'dur' => '1:20', 'views' => '90',  'rating' => '4.8','youtube_id' => 'p5dpnc3Oboc', 'bg' => '#D4F0E2', 'emoji' => '🥗'],
            ['id' => 6, 'cat' => 'anak',   'title' => 'NIKMAT BANGET❗ CARA MASAK SUP JAGUNG WORTEL NIKMAT YANG BIKIN KETAGIHAN','desc' => 'MENU BUBUR JAGUNG', 'dur' => '4:12', 'views' => '68rb', 'rating' => '5.0','youtube_id' => 'krSLwX5xWsU', 'bg' => '#AAFFC7', 'emoji' => '📏'],
        ];
    }

    private function getCatLabels(): array
    {
        return [
            'semua'  => 'Semua',
            'bayi'   => 'Edukasi Gizi',
            'anak'   => 'Menu Sehat                                                                                                                                                                                                                                                                                                                                                         ',
        ];
    }

    public function index()
    {
        $videos    = $this->getVideos();
        $catLabels = $this->getCatLabels();
        $activeTab = 'semua';

        return view('pages.edukasi', compact('videos', 'catLabels', 'activeTab'));
    }

    /**
     * Filter via AJAX — mengembalikan HTML partial view
     */
    public function filter(Request $request)
    {
        $cat    = $request->get('cat', 'semua');
        $all    = $this->getVideos();
        $videos = $cat === 'semua'
            ? $all
            : array_values(array_filter($all, fn($v) => $v['cat'] === $cat));

        $catLabels = $this->getCatLabels();

        return view('components.video-grid', compact('videos', 'catLabels'));
    }
}