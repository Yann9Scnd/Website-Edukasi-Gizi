<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GiziController extends Controller
{
    public function index()
    {
        $accordions = [
            [
                'key'   => 'karbo',
                'icon'  => '🌾',
                'bg'    => '#AAFFC7',
                'title' => 'Karbohidrat (30%)',
                'body'  => 'Karbohidrat adalah sumber energi utama tubuh. Pilih karbohidrat kompleks seperti nasi merah, roti gandum, oatmeal, singkong, dan jagung. Hindari konsumsi gula berlebihan. Kebutuhan harian: 250–300 gram untuk dewasa aktif.',
            ],
            [
                'key'   => 'protein',
                'icon'  => '🥩',
                'bg'    => '#D4F0E2',
                'title' => 'Protein (25%)',
                'body'  => 'Protein penting untuk pertumbuhan dan perbaikan sel tubuh. Sumber protein hewani: daging, ikan, telur, susu. Sumber protein nabati: tahu, tempe, kacang-kacangan. Kebutuhan: 0.8 gram per kg berat badan per hari.',
            ],
            [
                'key'   => 'sayur',
                'icon'  => '🥦',
                'bg'    => '#EAF4F5',
                'title' => 'Sayuran (30%)',
                'body'  => 'Sayuran kaya serat, vitamin, dan mineral. Pilih sayuran beragam warna: hijau (bayam, brokoli), orange (wortel), merah (tomat). Konsumsi minimal 250 gram sayuran setiap hari untuk kesehatan optimal.',
            ],
            [
                'key'   => 'buah',
                'icon'  => '🍊',
                'bg'    => '#E6EEF5',
                'title' => 'Buah-buahan (15%)',
                'body'  => 'Buah mengandung vitamin C, antioksidan, dan serat alami. Konsumsi 2–3 porsi buah per hari. Pilih buah segar lokal seperti pepaya, mangga, pisang, jambu biji. Vitamin C membantu penyerapan zat besi.',
            ],
        ];

        $nutrisi = [
            ['icon' => '🦴', 'title' => 'Kalsium',   'desc' => 'Untuk tulang dan gigi kuat. Ditemukan dalam susu, yogurt, keju, dan sayuran hijau gelap.'],
            ['icon' => '🩸', 'title' => 'Zat Besi',  'desc' => 'Mencegah anemia. Banyak terdapat dalam daging merah, hati ayam, tempe, dan bayam.'],
            ['icon' => '🔆', 'title' => 'Vitamin D',  'desc' => 'Mendukung imunitas dan tulang. Dari paparan sinar matahari, ikan, dan telur.'],
            ['icon' => '🧠', 'title' => 'Omega-3',   'desc' => 'Untuk kesehatan otak dan jantung. Sumber terbaik: ikan salmon, teri, kacang kenari.'],
        ];

        return view('pages.menu-gizi', compact('accordions', 'nutrisi'));
    }
}