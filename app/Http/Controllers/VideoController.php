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
            ['id' => 1, 'cat' => 'bayi',   'title' => 'MP-ASI Pertama Bayi 6 Bulan',           'desc' => 'Panduan lengkap memulai MPASI',                      'dur' => '8:24',  'views' => '12.4rb', 'rating' => '4.9','youtube_id' => 'LAfn4s8Jcps', 'bg' => '#AAFFC7', 'emoji' => '🥣'],
            ['id' => 2, 'cat' => 'anak',   'title' => 'Menu Sehat untuk Anak Aktif',             'desc' => 'Makanan bergizi untuk anak usia 3–6 tahun',          'dur' => '11:05', 'views' => '9.1rb',  'rating' => '4.8','youtube_id' => 'dQw4w9WgXcQ', 'bg' => '#D4F0E2', 'emoji' => '🥗'],
            ['id' => 3, 'cat' => 'hamil',  'title' => 'Nutrisi Penting Ibu Hamil Trimester 1',  'desc' => 'Asam folat dan nutrisi yang wajib dikonsumsi',        'dur' => '14:30', 'views' => '18.7rb', 'rating' => '5.0','youtube_id' => 'dQw4w9WgXcQ', 'bg' => '#EAF4F5', 'emoji' => '🤰'],
            ['id' => 4, 'cat' => 'bayi',   'title' => 'ASI Eksklusif 0–6 Bulan',                'desc' => 'Manfaat dan cara menyusui yang benar',                'dur' => '9:15',  'views' => '22.3rb', 'rating' => '4.9','youtube_id' => 'dQw4w9WgXcQ', 'bg' => '#E6EEF5', 'emoji' => '🍼'],
            ['id' => 5, 'cat' => 'remaja', 'title' => 'Gizi Seimbang untuk Remaja',             'desc' => 'Kebutuhan nutrisi masa pubertas',                    'dur' => '12:00', 'views' => '7.5rb',  'rating' => '4.7','youtube_id' => 'dQw4w9WgXcQ', 'bg' => '#FFF0E6', 'emoji' => '🧑'],
            ['id' => 6, 'cat' => 'anak',   'title' => 'Mencegah Stunting pada Anak',             'desc' => 'Deteksi dini dan cara mencegah stunting',            'dur' => '16:42', 'views' => '31.2rb', 'rating' => '5.0','youtube_id' => 'dQw4w9WgXcQ', 'bg' => '#AAFFC7', 'emoji' => '📏'],
            ['id' => 7, 'cat' => 'lansia', 'title' => 'Gizi untuk Orang Tua di Atas 60 Tahun',  'desc' => 'Kebutuhan nutrisi khusus untuk lansia',              'dur' => '13:10', 'views' => '5.8rb',  'rating' => '4.6','youtube_id' => 'dQw4w9WgXcQ', 'bg' => '#D4F0E2', 'emoji' => '👴'],
            ['id' => 8, 'cat' => 'hamil',  'title' => 'Makanan yang Harus Dihindari Saat Hamil', 'desc' => 'Panduan keamanan pangan untuk ibu hamil',            'dur' => '10:45', 'views' => '14.9rb', 'rating' => '4.8','youtube_id' => 'dQw4w9WgXcQ', 'bg' => '#EAF4F5', 'emoji' => '🚫'],
            ['id' => 9, 'cat' => 'bayi',   'title' => 'Gizi Bayi Usia 6–12 Bulan',              'desc' => 'Perkembangan dan kebutuhan gizi bayi',               'dur' => '15:20', 'views' => '16.1rb', 'rating' => '4.9','youtube_id' => 'dQw4w9WgXcQ',  'bg' => '#E6EEF5', 'emoji' => '👶'],
        ];
    }

    private function getCatLabels(): array
    {
        return [
            'semua'  => 'Semua',
            'bayi'   => 'Gizi Bayi',
            'anak'   => 'Gizi Anak',
            'hamil'  => 'Ibu Hamil',
            'remaja' => 'Remaja',
            'lansia' => 'Lansia',
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