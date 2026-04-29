@extends('layouts.app')

@section('title', 'Resep Sehat')

@section('content')
<div class="resep-section">
    <h2 class="section-title fade-up">👨‍🍳 Resep Menu Gizi Seimbang</h2>
    <p class="section-sub fade-up">Panduan memasak menu bergizi dengan langkah yang mudah diikuti</p>

    <div class="resep-grid">
        @foreach($resepData as $resep)
        <div class="resep-card">
            <div class="resep-thumb" style="background: {{ $resep['bg'] }}">
                <div style="font-size:5rem;opacity:0.5">{{ $resep['emoji'] }}</div>
                <div style="position:absolute;top:12px;left:12px;background:var(--teal);color:white;font-size:0.72rem;font-weight:700;padding:4px 12px;border-radius:50px">
                    {{ $resep['waktu'] }}
                </div>
            </div>
            <div class="resep-info">
                <h3>{{ $resep['title'] }}</h3>
                <p>{{ $resep['desc'] }}</p>
                <div class="resep-meta">
                    <span class="resep-tag">⏱ {{ $resep['waktu'] }}</span>
                    <span class="resep-tag">🍽 {{ $resep['porsi'] }}</span>
                </div>
                <div class="steps-preview">
                    @foreach($resep['steps'] as $i => $step)
                    <div class="step-row">
                        <div class="step-num">{{ $i + 1 }}</div>
                        <p>{{ $step }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection