{{-- resources/views/components/card.blade.php
     Props: $icon, $color, $title, $desc, $route
--}}
<div class="menu-card" onclick="window.location='{{ route($route) }}'">
    <div class="icon {{ $color }}">{{ $icon }}</div>
    <h3>{{ $title }}</h3>
    <p>{{ $desc }}</p>
</div>