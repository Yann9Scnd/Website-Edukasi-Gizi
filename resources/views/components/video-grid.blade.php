{{-- resources/views/components/video-grid.blade.php
     Digunakan sebagai partial response untuk AJAX filter video
--}}
@foreach($videos as $video)
<div class="video-card" onclick="openVideo('{{ $video['youtube_id'] }}')">
<div class="video-thumb">
    <img 
        src="https://img.youtube.com/vi/{{ $video['youtube_id'] }}/hqdefault.jpg"
        style="width:100%; height:100%; object-fit:cover;"
    >

    <div class="play-btn">▶</div>
   
    <div class="video-duration">{{ $video['dur'] }}</div>
    <div class="video-tag">{{ $catLabels[$video['cat']] }}</div>
</div>
    <div class="video-info">
        <h4>{{ $video['title'] }}</h4>
        <p>{{ $video['desc'] }}</p>
        <div class="video-meta">
            <span class="views">👁 {{ $video['views'] }} ditonton</span>
            <span class="rating">★ {{ $video['rating'] }}</span>
        </div>
    </div>
</div>
@endforeach