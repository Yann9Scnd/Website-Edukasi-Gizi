{{-- resources/views/components/navbar.blade.php --}}
<nav>
    <a class="nav-logo" href="{{ route('home') }}">
         <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="logo-icon">
        NadiBunda
    </a>

    <ul class="nav-links" id="navLinks">
        <li>
            <a href="{{ route('home') }}"
               class="{{ request()->routeIs('home') ? 'active' : '' }}">
                🏠 Beranda
            </a>
        </li>
        <li>
            <a href="{{ route('video.index') }}"
               class="{{ request()->routeIs('video.*') ? 'active' : '' }}">
                ▶ Video Edukasi
            </a>
        </li>
        <li>
            <a href="{{ route('gizi.index') }}"
               class="{{ request()->routeIs('gizi.*') ? 'active' : '' }}">
                🍽 Gizi Seimbang
            </a>
        </li>
        <li>
            <a href="{{ route('resep.index') }}"
               class="{{ request()->routeIs('resep.*') ? 'active' : '' }}">
                👨‍🍳 Resep
            </a>
        </li>
        <li>
            <a href="{{ route('kalkulator.index') }}"
               class="nav-cta {{ request()->routeIs('kalkulator.*') ? 'active' : '' }}">
                ⚖️ Kalkulator Bayi
            </a>
        </li>
    </ul>

    <div class="hamburger" id="hamburger" onclick="toggleMenu()">
        <span></span><span></span><span></span>
    </div>
</nav>