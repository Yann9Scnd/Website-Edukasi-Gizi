<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KalkulatorController extends Controller
{
    public function index()
    {
        return view('pages.kalkulator');
    }

    public function hitung(Request $request)
    {
        // ── Validasi Input ──────────────────────────────────────────
        $validated = $request->validate([
            'jenis_kelamin' => ['required', 'in:laki,perempuan'],
            'usia'          => ['required', 'numeric', 'min:0', 'max:60'],
            'tinggi'        => ['required', 'numeric', 'min:40', 'max:130'],
            'berat'         => ['required', 'numeric', 'min:1', 'max:30'],
        ], [
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in'       => 'Jenis kelamin tidak valid.',
            'usia.required'          => 'Usia wajib diisi.',
            'usia.min'               => 'Usia minimal 0 bulan.',
            'usia.max'               => 'Usia maksimal 60 bulan.',
            'tinggi.required'        => 'Tinggi badan wajib diisi.',
            'tinggi.min'             => 'Tinggi minimal 40 cm.',
            'tinggi.max'             => 'Tinggi maksimal 130 cm.',
            'berat.required'         => 'Berat badan wajib diisi.',
            'berat.min'              => 'Berat minimal 1 kg.',
            'berat.max'              => 'Berat maksimal 30 kg.',
        ]);

        $gender = $validated['jenis_kelamin'];
        $usia   = (float) $validated['usia'];
        $tinggi = (float) $validated['tinggi'];
        $berat  = (float) $validated['berat'];

        // ── Referensi WHO 2006 (simplified median & ±2SD) ──────────
        $whoRef = $this->getWhoRef();

        $bbuRef = $this->getNearestRef($whoRef[$gender]['bbu'], $usia);
        $tbuRef = $this->getNearestRef($whoRef[$gender]['tbu'], $usia);

        $sdBbu  = ($bbuRef[2] - $bbuRef[1]) / 4;
        $sdTbu  = ($tbuRef[2] - $tbuRef[1]) / 4;

        $bbuZ  = $sdBbu  > 0 ? ($berat  - $bbuRef[0]) / $sdBbu  : 0;
        $tbuZ  = $sdTbu  > 0 ? ($tinggi - $tbuRef[0]) / $sdTbu  : 0;
        $bbtbZ = $bbuZ; // simplified
        $imt   = $berat / (($tinggi / 100) ** 2);

        $bbuStatus  = $this->zToStatus($bbuZ);
        $tbuStatus  = $this->zToStatus($tbuZ);
        $bbtbStatus = $this->zToStatus($bbtbZ);
        $imtStatus  = $imt < 14 ? ['label' => 'Kurang', 'cls' => 'status-kurang']
                    : ($imt <= 20 ? ['label' => 'Normal ✓', 'cls' => 'status-normal']
                    : ['label' => 'Lebih', 'cls' => 'status-lebih']);

        // Bar marker position (0–100%)
        $barPct = round(max(0, min(100, (($bbuZ + 3) / 6) * 100)));

        // Warna icon bayi
        $babyBg = match($bbuStatus['cls']) {
            'status-normal' => '#E6FFF0',
            'status-kurang' => '#FFF4E6',
            default         => '#FFE8E8',
        };

        // Saran / rekomendasi
        $saran = $this->buildSaran($bbuStatus['cls'], $tbuStatus['cls']);

        $result = [
            'title'       => ($gender === 'laki' ? 'Putra' : 'Putri') . ' Anda Usia ' . (int)$usia . ' Bulan',
            'subtitle'    => "BB: {$berat} kg | TB: {$tinggi} cm | Ref: WHO Child Growth Standards 2006",
            'babyBg'      => $babyBg,
            'bbuVal'      => number_format($berat, 1) . ' kg',
            'bbuStatus'   => $bbuStatus,
            'tbuVal'      => number_format($tinggi, 1) . ' cm',
            'tbuStatus'   => $tbuStatus,
            'bbtbVal'     => number_format($berat, 1) . ' kg',
            'bbtbStatus'  => $bbtbStatus,
            'imtVal'      => number_format($imt, 1),
            'imtStatus'   => $imtStatus,
            'barPct'      => $barPct,
            'saran'       => $saran,
        ];

        // Jika request AJAX, kembalikan JSON
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'result' => $result]);
        }

        return view('pages.kalkulator', compact('result'));
    }

    // ── Helpers ──────────────────────────────────────────────────────

    private function getNearestRef(array $data, float $usia): array
    {
        $months  = array_keys($data);
        $nearest = $months[0];
        foreach ($months as $m) {
            if (abs($m - $usia) < abs($nearest - $usia)) {
                $nearest = $m;
            }
        }
        return $data[$nearest];
    }

    private function zToStatus(float $z): array
    {
        if ($z < -3) return ['label' => 'Sangat Kurang', 'cls' => 'status-kurang'];
        if ($z < -2) return ['label' => 'Kurang',        'cls' => 'status-kurang'];
        if ($z <=  2) return ['label' => 'Normal ✓',     'cls' => 'status-normal'];
        return           ['label' => 'Lebih',             'cls' => 'status-lebih'];
    }

    private function buildSaran(string $bbuCls, string $tbuCls): string
    {
        if ($bbuCls === 'status-normal' && $tbuCls === 'status-normal') {
            return 'Pertumbuhan bayi Anda dalam kondisi normal dan sehat! Pertahankan pola makan bergizi seimbang, ASI (jika masih menyusui), dan stimulasi tumbuh kembang yang baik. Lanjutkan imunisasi rutin sesuai jadwal.';
        }
        if ($bbuCls === 'status-kurang') {
            return 'Berat badan di bawah normal. Segera konsultasikan dengan dokter atau ahli gizi. Tingkatkan frekuensi dan kualitas makan, berikan makanan padat energi dan protein seperti telur, ikan, dan kacang-kacangan. Pantau tumbuh kembang setiap bulan.';
        }
        if ($tbuCls === 'status-kurang') {
            return 'Tinggi badan menunjukkan risiko stunting. Konsultasikan dengan Puskesmas atau dokter anak segera. Perkaya menu dengan protein hewani, zinc (daging, ikan), kalsium (susu, keju), dan pastikan asupan makanan cukup setiap hari.';
        }
        return 'Berat badan di atas normal. Perhatikan kualitas makanan, kurangi makanan tinggi gula dan lemak jenuh. Perbanyak aktivitas fisik yang sesuai usia. Konsultasikan dengan dokter untuk rencana diet yang sehat.';
    }

    private function getWhoRef(): array
    {
        return [
            'laki' => [
                'bbu' => [
                     0 => [3.3, 2.5,  4.4],   3 => [6.0, 4.9,  7.2],
                     6 => [7.9, 6.4,  9.7],   9 => [9.2, 7.5, 11.0],
                    12 => [10.2, 8.3, 12.2],  18 => [11.5, 9.4, 13.8],
                    24 => [12.5, 10.2, 15.0], 36 => [14.3, 11.6, 17.2],
                    48 => [16.3, 13.1, 19.8], 60 => [18.3, 14.7, 22.3],
                ],
                'tbu' => [
                     0 => [49.9, 46.1, 53.7],  3 => [61.4, 57.3, 65.5],
                     6 => [67.6, 63.3, 71.9],  9 => [72.3, 68.0, 76.6],
                    12 => [75.7, 71.3, 80.2], 18 => [82.3, 77.7, 86.9],
                    24 => [87.8, 83.1, 92.6], 36 => [96.1, 91.1, 101.1],
                    48 => [103.3, 98.2, 108.4], 60 => [110.0, 104.7, 115.3],
                ],
            ],
            'perempuan' => [
                'bbu' => [
                     0 => [3.2, 2.4,  4.2],   3 => [5.8, 4.6,  7.1],
                     6 => [7.3, 5.7,  9.2],   9 => [8.6, 6.7, 10.6],
                    12 => [9.5, 7.5, 11.8],  18 => [10.9, 8.7, 13.2],
                    24 => [12.0, 9.7, 14.6], 36 => [14.0, 11.4, 17.0],
                    48 => [15.9, 12.9, 19.4], 60 => [17.7, 14.3, 22.0],
                ],
                'tbu' => [
                     0 => [49.1, 45.4, 52.9],  3 => [59.8, 55.8, 63.8],
                     6 => [65.7, 61.5, 69.9],  9 => [70.1, 66.0, 74.2],
                    12 => [74.0, 69.6, 78.5], 18 => [80.7, 76.3, 85.1],
                    24 => [86.4, 81.7, 91.1], 36 => [95.1, 90.1, 100.1],
                    48 => [102.7, 97.6, 107.8], 60 => [109.4, 104.1, 114.7],
                ],
            ],
        ];
    }
}