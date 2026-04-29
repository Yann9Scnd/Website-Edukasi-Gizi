@extends('layouts.app')

@section('title', 'Kalkulator Gizi Bayi')

@section('content')
<div class="kalk-section">
    <h2 class="section-title fade-up">⚖️ Kalkulator Gizi Bayi</h2>
    <p class="section-sub fade-up">Pantau tumbuh kembang bayi dan anak dengan indikator WHO</p>

    <div class="kalk-card fade-up">
        <div class="kalk-header">
            <div class="kalk-icon-big">👶</div>
            <h2>Cek Status Gizi Bayi &amp; Anak</h2>
            <p>Masukkan data lengkap untuk mendapatkan hasil yang akurat</p>
        </div>

        {{-- Validation Errors --}}
        @if($errors->any())
        <div style="background:#FFE8E8;border-left:4px solid #C0392B;border-radius:12px;padding:1rem 1.25rem;margin-bottom:1rem;">
            <p style="font-weight:700;color:#C0392B;margin-bottom:0.5rem;">⚠️ Harap perbaiki input berikut:</p>
            <ul style="list-style:none;color:#8B0000;font-size:0.88rem;">
                @foreach($errors->all() as $error)
                <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Form --}}
        <form id="kalkForm" method="POST" action="{{ route('kalkulator.hitung') }}">
            @csrf
            <div class="kalk-form">
                <div class="form-group">
                    <label for="jenis_kelamin">👦 Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" required>
                        <option value="">-- Pilih jenis kelamin --</option>
                        <option value="laki"      {{ old('jenis_kelamin') === 'laki'      ? 'selected' : '' }}>Laki-laki</option>
                        <option value="perempuan" {{ old('jenis_kelamin') === 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="usia">📅 Usia (dalam bulan)</label>
                    <input type="number" name="usia" id="usia"
                           placeholder="Contoh: 24" min="0" max="60"
                           value="{{ old('usia') }}" required>
                </div>
                <div class="form-group">
                    <label for="tinggi">📏 Tinggi / Panjang Badan (cm)</label>
                    <input type="number" name="tinggi" id="tinggi"
                           placeholder="Contoh: 82" step="0.1"
                           value="{{ old('tinggi') }}" required>
                </div>
                <div class="form-group">
                    <label for="berat">⚖️ Berat Badan (kg)</label>
                    <input type="number" name="berat" id="berat"
                           placeholder="Contoh: 11.5" step="0.1"
                           value="{{ old('berat') }}" required>
                </div>
            </div>

            <button type="submit" class="kalk-btn" id="kalkBtn">
                <span id="kalkBtnText">⚖️ Hitung Status Gizi Sekarang</span>
                <span id="kalkBtnLoad" style="display:none">⏳ Menghitung...</span>
            </button>
        </form>

        {{-- Result Box --}}
        <div class="kalk-result {{ isset($result) ? 'show' : '' }}" id="kalkResult">
            @if(isset($result))
            <div class="result-header">
                <div class="baby-icon" style="background: {{ $result['babyBg'] }}">👶</div>
                <div>
                    <div class="result-title">{{ $result['title'] }}</div>
                    <div class="result-sub">{{ $result['subtitle'] }}</div>
                </div>
            </div>

            <div class="indicators">
                @php
                    $indikators = [
                        ['label' => 'BERAT menurut USIA (BB/U)', 'val' => $result['bbuVal'],  'status' => $result['bbuStatus']],
                        ['label' => 'TINGGI menurut USIA (TB/U)', 'val' => $result['tbuVal'],  'status' => $result['tbuStatus']],
                        ['label' => 'BERAT menurut TINGGI (BB/TB)', 'val' => $result['bbtbVal'], 'status' => $result['bbtbStatus']],
                        ['label' => 'IMT (Indeks Massa Tubuh)',    'val' => $result['imtVal'],  'status' => $result['imtStatus']],
                    ];
                @endphp
                @foreach($indikators as $ind)
                <div class="indicator">
                    <div class="ind-label">{{ $ind['label'] }}</div>
                    <div class="ind-value" style="color:var(--teal)">{{ $ind['val'] }}</div>
                    <div class="ind-status {{ $ind['status']['cls'] }}">{{ $ind['status']['label'] }}</div>
                </div>
                @endforeach
            </div>

            <div class="status-bar-wrap">
                <div class="bar-label">📊 Indikator Berat Badan (BB/U)</div>
                <div class="bar-track">
                    <div class="bar-marker" style="left: {{ $result['barPct'] }}%"></div>
                </div>
                <div class="bar-zones">
                    <span>Gizi Kurang</span>
                    <span>Normal ✓</span>
                    <span>Gizi Lebih</span>
                </div>
            </div>

            <div class="saran-box">
                <h4>💡 Rekomendasi</h4>
                <p>{{ $result['saran'] }}</p>
            </div>
            @endif
        </div>

    </div>{{-- .kalk-card --}}
</div>{{-- .kalk-section --}}
@endsection

@push('scripts')
<script>
/**
 * AJAX submit — menghindari full page reload
 */
document.getElementById('kalkForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const btn      = document.getElementById('kalkBtn');
    const btnText  = document.getElementById('kalkBtnText');
    const btnLoad  = document.getElementById('kalkBtnLoad');
    btn.disabled   = true;
    btnText.style.display = 'none';
    btnLoad.style.display = 'inline';

    const formData = new FormData(this);

    fetch('{{ route('kalkulator.hitung') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: formData,
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            renderResult(data.result);
            showToast('✅ Hasil sudah dihitung!');
        }
    })
    .catch(() => showToast('⚠️ Terjadi kesalahan, coba lagi.'))
    .finally(() => {
        btn.disabled = false;
        btnText.style.display = 'inline';
        btnLoad.style.display = 'none';
    });
});

function renderResult(r) {
    const box = document.getElementById('kalkResult');

    const indikators = [
        { label: 'BERAT menurut USIA (BB/U)',      val: r.bbuVal,  status: r.bbuStatus  },
        { label: 'TINGGI menurut USIA (TB/U)',     val: r.tbuVal,  status: r.tbuStatus  },
        { label: 'BERAT menurut TINGGI (BB/TB)',   val: r.bbtbVal, status: r.bbtbStatus },
        { label: 'IMT (Indeks Massa Tubuh)',        val: r.imtVal,  status: r.imtStatus  },
    ];

    box.innerHTML = `
        <div class="result-header">
            <div class="baby-icon" style="background:${r.babyBg}">👶</div>
            <div>
                <div class="result-title">${r.title}</div>
                <div class="result-sub">${r.subtitle}</div>
            </div>
        </div>
        <div class="indicators">
            ${indikators.map(i => `
                <div class="indicator">
                    <div class="ind-label">${i.label}</div>
                    <div class="ind-value" style="color:var(--teal)">${i.val}</div>
                    <div class="ind-status ${i.status.cls}">${i.status.label}</div>
                </div>
            `).join('')}
        </div>
        <div class="status-bar-wrap">
            <div class="bar-label">📊 Indikator Berat Badan (BB/U)</div>
            <div class="bar-track">
                <div class="bar-marker" style="left:${r.barPct}%"></div>
            </div>
            <div class="bar-zones">
                <span>Gizi Kurang</span><span>Normal ✓</span><span>Gizi Lebih</span>
            </div>
        </div>
        <div class="saran-box">
            <h4>💡 Rekomendasi</h4>
            <p>${r.saran}</p>
        </div>
    `;

    box.classList.add('show');
    box.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}
</script>
@endpush