<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResepController extends Controller
{
    public function index()
    {
        $resepData = [
                    [
                        'title' => 'Bubur Singkong Kukuruyuk, Saus Jeruk',
                        'image' => asset('assets/bubursingkong.png'),
                        'bg'    => '#AAFFC7',
                        'desc'  => 'Menu MPASI bergizi lengkap untuk bayi 6-8 bulan',
                        'waktu' => '30 menit',
                        'porsi' => '3 porsi',

                        'bahan' => [
                            '60 gr singkong putih, rebus dan haluskan',
                            '20 gr daging ikan kembung, cincang halus',
                            '10 gr daging ayam',
                            '1 sdt minyak kelapa',
                            '100 cc kaldu ayam',
                            '1 sdm sari jeruk manis',
                            '20 gr bayam segar',
                        ],

                        'gizi' => [
                            'Energi' => '187 kkal',
                            'Protein' => '7,9 gr',
                            'Lemak' => '7,8 gr',
                        ],

                        'cara' => [
                            'Rebus air kaldu, masukkan singkong, ikan, ayam dan minyak.',
                            'Aduk hingga setengah matang.',
                            'Masukkan bayam hingga matang.',
                            'Blender/saring hingga halus.',
                            'Tambahkan saus jeruk sebelum disajikan.',
                        ],
                   
                        ],
            [
                'title' => 'Tumis Tempe Brokoli',
                'emoji' => '🥦',
                'bg'    => '#D4F0E2',
                'desc'  => 'Sumber protein dan serat tinggi untuk keluarga',
                'waktu' => '20 menit',
                'porsi' => '4 porsi',
                    'bahan' => [],
    'gizi' => [],
    'cara' => [],

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
                    'bahan' => [],
    'gizi' => [],
    'cara' => [],

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
                    'bahan' => [],
    'gizi' => [],
    'cara' => [],

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