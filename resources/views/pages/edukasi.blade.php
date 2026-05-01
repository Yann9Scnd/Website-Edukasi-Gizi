@extends('layouts.app')

@section('title', 'Video Edukasi')

@section('content')
<div class="video-section">
    <h2 class="section-title fade-up">🎬 Video Edukasi                                                                                                                          </h2>
    <p class="section-sub fade-up">Pelajari gizi dengan cara yang menyenangkan melalui video edukatif</p>

    {{-- Category Tabs --}}
    <div class="category-tabs fade-up" id="categoryTabs">
        @php
            $tabs = [
                'semua'  => '🌿 Semua',
                'bayi'   => '👶 Edukasi Gizi',
                'anak'   => 'Menu Sehat',
            ];
        @endphp

        @foreach($tabs as $key => $label)
        <button
            class="tab-btn {{ $activeTab === $key ? 'active' : '' }}"
            data-cat="{{ $key }}"
            onclick="filterVideos('{{ $key }}', this)">
            {{ $label }}
        </button>
        @endforeach
    </div>

    {{-- Video Grid --}}
    <div class="video-grid" id="videoGrid">
        @include('components.video-grid', ['videos' => $videos, 'catLabels' => $catLabels])
    </div>
</div>
@endsection

@push('scripts')
<script>
function filterVideos(cat, btn) {
    // Update active tab UI
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const grid = document.getElementById('videoGrid');
    grid.style.opacity = '0.4';
    grid.style.transition = 'opacity 0.2s';

    // AJAX request ke VideoController@filter
    fetch(`{{ route('video.filter') }}?cat=${cat}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => res.text())
    .then(html => {
        grid.innerHTML = html;
        grid.style.opacity = '1';
        showToast('✅ Filter berhasil!');
    })
    .catch(() => {
        grid.style.opacity = '1';
        showToast('⚠️ Gagal memuat video.');
    });
}
</script>
@endpush