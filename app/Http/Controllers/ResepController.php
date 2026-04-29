<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResepController extends Controller
{
    public function index()
    {
        $resepData = [
            [
                'title' => 'Bubur Ayam Sayuran (MPASI)',
                'emoji' => '🥣',
                'bg'    => '#AAFFC7',
                'desc'  => 'Menu MPASI bergizi lengkap untuk bayi 8 bulan ke atas',
                'waktu' => '30 menit',
                'porsi' => '3 porsi',
                'steps' => [
                    'Masak beras dengan kaldu ayam hingga lembut.',
                    'Tumis bawang putih, tambahkan dada ayam cincang.',
                    'Tambahkan wortel dan bayam yang sudah dicincang halus.',
                    'Campurkan semua bahan, tambahkan sedikit minyak zaitun.',
                ],
            ],
            [
                'title' => 'Tumis Tempe Brokoli',
                'emoji' => '🥦',
                'bg'    => '#D4F0E2',
                'desc'  => 'Sumber protein dan serat tinggi untuk keluarga',
                'waktu' => '20 menit',
                'porsi' => '4 porsi',
                'steps' => [
                    'Potong tempe dan brokoli sesuai selera.',
                    'Panaskan minyak, tumis bawang merah dan putih.',
                    'Masukkan tempe, goreng hingga kekuningan.',
                    'Tambahkan brokoli, bumbu, aduk rata dan sajikan.',
                ],
            ],
            [
                'title' => 'Ikan Salmon Kukus Lemon',
                'emoji' => '🐟',
                'bg'    => '#EAF4F5',
                'desc'  => 'Tinggi Omega-3 dan protein untuk otak anak',
                'waktu' => '25 menit',
                'porsi' => '2 porsi',
                'steps' => [
                    'Bersihkan fillet salmon, lumuri garam dan lemon.',
                    'Siapkan pengukus dengan air mendidih.',
                    'Kukus salmon selama 10–12 menit hingga matang.',
                    'Sajikan dengan nasi merah dan sayuran rebus.',
                ],
            ],
            [
                'title' => 'Salad Buah dengan Yogurt',
                'emoji' => '🍓',
                'bg'    => '#E6EEF5',
                'desc'  => 'Camilan sehat kaya vitamin dan probiotik',
                'waktu' => '10 menit',
                'porsi' => '2 porsi',
                'steps' => [
                    'Cuci dan potong semua buah segar.',
                    'Campurkan yogurt plain tanpa gula.',
                    'Tambahkan madu secukupnya.',
                    'Taburi granola atau biji chia untuk tekstur.',
                ],
            ],
        ];

        return view('pages.resep', compact('resepData'));
    }
}