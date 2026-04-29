<?php

namespace App\Http\Controllers;

use Illuminate\Http\request;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            ['num' => '30+',   'label' => 'Video Edukasi'],
            ['num' => '100+',  'label' => 'Resep Sehat'],
            ['num' => '1rb+', 'label' => 'Pengguna'],
        ];

        $menuCards = [
            [
                'icon'    => '🎬',
                'color'   => 'ic-mint',
                'title'   => 'Video Edukasi Gizi',
                'desc'    => 'Tonton video edukasi gizi yang mudah dipahami semua kalangan',
                'route'   => 'video.index',
            ],
            [
                'icon'    => '🍽',
                'color'   => 'ic-green',
                'title'   => 'Gizi Seimbang',
                'desc'    => 'Panduan visual piring gizi seimbang dan kebutuhan nutrisi harian',
                'route'   => 'gizi.index',
            ],
            [
                'icon'    => '👨‍🍳',
                'color'   => 'ic-teal',
                'title'   => 'Resep Masak Sehat',
                'desc'    => 'Langkah-langkah memasak menu bergizi untuk si kecil',
                'route'   => 'resep.index',
            ],
            [
                'icon'    => '⚖️',
                'color'   => 'ic-blue',
                'title'   => 'Kalkulator Gizi Bayi',
                'desc'    => 'Cek status gizi bayi dan anak secara cepat dan akurat',
                'route'   => 'kalkulator.index',
            ],
        ];

        return view('pages.home', compact('stats', 'menuCards'));
    }
}