@extends('layouts.app')

@section('title', 'Menu Gizi Seimbang')

@section('content')
<div class="gizi-section">
    <h2 class="section-title fade-up">🍽 Gizi Seimbang</h2>
    <p class="section-sub fade-up">Panduan visual dan interaktif untuk memahami kebutuhan gizi harian</p>

    <div class="gizi-hero">
        {{-- Piring Gizi SVG --}}
        <div class="plate-wrapper">
            <svg viewBox="0 0 360 360" xmlns="http://www.w3.org/2000/svg" style="max-width:340px;width:100%;">
                <circle cx="180" cy="180" r="165" fill="white" stroke="#E0E8EB" stroke-width="6"/>
                <circle cx="180" cy="180" r="155" fill="#F7FAFB"/>
                <path d="M180,180 L180,30 A150,150 0 0,0 30,180 Z"  fill="#AAFFC7" opacity="0.9" style="cursor:pointer" onclick="highlightPlate('karbo')"   class="plate-seg"/>
                <path d="M180,180 L330,180 A150,150 0 0,0 180,30 Z" fill="#67C090" opacity="0.9" style="cursor:pointer" onclick="highlightPlate('protein')" class="plate-seg"/>
                <path d="M180,180 L30,180 A150,150 0 0,0 180,330 Z"  fill="#215B63" opacity="0.8" style="cursor:pointer" onclick="highlightPlate('sayur')"   class="plate-seg"/>
                <path d="M180,180 L180,330 A150,150 0 0,0 330,180 Z" fill="#124170" opacity="0.85" style="cursor:pointer" onclick="highlightPlate('buah')"   class="plate-seg"/>
                <circle cx="180" cy="180" r="50" fill="white" stroke="#E0E8EB" stroke-width="3"/>
                <text x="180" y="173" text-anchor="middle" font-size="24">🍽</text>
                <text x="180" y="192" text-anchor="middle" font-size="9"  fill="#215B63" font-weight="700">PIRING GIZI</text>
                <text x="180" y="202" text-anchor="middle" font-size="8"  fill="#7A9BA3">SEIMBANG</text>
                <text x="100" y="130" text-anchor="middle" font-size="13" fill="#1A4030" font-weight="800">🌾</text>
                <text x="100" y="146" text-anchor="middle" font-size="9.5" fill="#1A4030" font-weight="700">Karbohidrat</text>
                <text x="100" y="158" text-anchor="middle" font-size="8" fill="#2A6050" opacity="0.85">30%</text>
                <text x="260" y="130" text-anchor="middle" font-size="13" fill="white">🥩</text>
                <text x="260" y="146" text-anchor="middle" font-size="9.5" fill="white" font-weight="700">Protein</text>
                <text x="260" y="158" text-anchor="middle" font-size="8"  fill="white" opacity="0.85">25%</text>
                <text x="100" y="230" text-anchor="middle" font-size="13" fill="white">🥦</text>
                <text x="100" y="246" text-anchor="middle" font-size="9.5" fill="white" font-weight="700">Sayuran</text>
                <text x="100" y="258" text-anchor="middle" font-size="8"  fill="white" opacity="0.85">30%</text>
                <text x="260" y="230" text-anchor="middle" font-size="13" fill="white">🍊</text>
                <text x="260" y="246" text-anchor="middle" font-size="9.5" fill="white" font-weight="700">Buah</text>
                <text x="260" y="258" text-anchor="middle" font-size="8"  fill="white" opacity="0.85">15%</text>
                <ellipse cx="330" cy="80"  rx="18" ry="8"  fill="#A8D8EA"/>
                <rect    x="312"  y="80"  width="36" height="42" rx="4" fill="#C5E8F5" opacity="0.7"/>
                <ellipse cx="330" cy="122" rx="18" ry="8"  fill="#A8D8EA"/>
                <text x="330" y="140" text-anchor="middle" font-size="8" fill="#215B63" font-weight="700">Air</text>
            </svg>
        </div>

        {{-- Accordion --}}
        <div>
            <h3 style="font-family:'Quicksand',sans-serif;font-size:1.4rem;font-weight:800;color:var(--blue);margin-bottom:0.75rem;">
                Piring Gizi Seimbang
            </h3>
            <p style="color:var(--text-soft);font-size:0.88rem;margin-bottom:1.5rem;line-height:1.7;">
                Klik setiap bagian piring untuk melihat detail nutrisi. Konsumsi makanan bervariasi setiap hari untuk memenuhi kebutuhan gizi tubuh.
            </p>

            <div class="accordion-list">
                @foreach($accordions as $acc)
                <div class="accordion-item" id="acc-{{ $acc['key'] }}">
                    <div class="accordion-header" onclick="toggleAccordion('{{ $acc['key'] }}')">
                        <div class="accordion-icon" style="background: {{ $acc['bg'] }}">{{ $acc['icon'] }}</div>
                        {{ $acc['title'] }}
                        <span class="accordion-arrow">▼</span>
                    </div>
                    <div class="accordion-body">
                        <p>{{ $acc['body'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Nutrisi Grid --}}
    <h3 class="section-title" style="font-size:1.25rem;margin-bottom:1rem;">Kandungan Nutrisi Penting</h3>
    <div class="nutrisi-grid">
        @foreach($nutrisi as $item)
        <div class="nutrisi-card">
            <div class="ni">{{ $item['icon'] }}</div>
            <h4>{{ $item['title'] }}</h4>
            <p>{{ $item['desc'] }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
function highlightPlate(key) {
    toggleAccordion(key);
}
</script>
@endpush