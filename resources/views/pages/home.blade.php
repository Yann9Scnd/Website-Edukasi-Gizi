@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- ── HERO ── --}}
<section class="hero">
    <div class="hero-inner">
        <div class="hero-text fade-up">
            <div class="hero-badge">🌿 Edukasi Gizi Terpercaya</div>
            <h1>Tumbuh Hebat Dimulai dari <span>Gizi yang Tepat</span></h1>
            <p>hadir sebagai sahabat cerdas bagi setiap ibu dalam mendampingi tumbuh kembang balita melalui pemenuhan gizi yang tepat, praktis, dan menyenangkan.</p>
            <div class="hero-buttons">
                <a class="btn-primary" href="{{ route('kalkulator.index') }}">⚖️ Hitung Gizi Bayi</a>
                <a class="btn-secondary" href="{{ route('video.index') }}">▶ Tonton Video</a>
            </div>
        </div>

        <div class="hero-visual fade-up delay-2">
            <div class="hero-illustration">
                <div class="hero-illustration">
    <img src="{{ asset('assets/imgutama.jpeg') }}" alt="Ilustrasi" class="family-img">
</div>

                {{-- Stats --}}
                <div class="hero-stats">
                    @foreach($stats as $stat)
                    <div class="stat-card">
                        <div class="num">{{ $stat['num'] }}</div>
                        <div class="lbl">{{ $stat['label'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── ABOUT / DESKRIPSI ── --}}
<section class="about fade-up">
    <div class="container">
        <h2 class="section-title">Tentang NadiBunda</h2>
        <p class="about-text">
            <strong>NadiBunda</strong> hadir sebagai sahabat cerdas bagi setiap ibu dalam mendampingi tumbuh kembang balita melalui pemenuhan gizi yang tepat, praktis, dan menyenangkan.
        </p>

        <p class="about-text">
            Di tengah kesibukan sehari-hari, NadiBunda membantu ibu menemukan solusi mudah untuk memastikan si kecil mendapatkan asupan terbaik. Website ini dirancang dengan pendekatan sederhana namun berbasis ilmu kebidanan dan kesehatan anak.
        </p>

        <div class="about-list">
            <div>🥣 Gizi Seimbang</div>
            <div>📊 Kalkulator Gizi Bayi</div>
            <div>🎥 Video edukasi Gizi</div>
            <div>🍳 Resep Masak Sehat</div>
        </div>

        <p class="about-text highlight">
            Lebih dari sekadar website, NadiBunda adalah ruang belajar dan berbagi bagi ibu untuk memberikan yang terbaik bagi buah hati.
        </p>
    </div>
</section>

{{-- ── QUICK MENU ── --}}
<div class="quick-menu fade-up delay-2">
    <h2 class="section-title">Jelajahi Menu Kami</h2>
    <p class="section-sub">Pilih topik yang ingin Anda pelajari hari ini</p>
    <div class="menu-grid">
        @foreach($menuCards as $card)
            @include('components.card', $card)
        @endforeach
    </div>
</div>

@endsection