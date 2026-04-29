{{-- resources/views/components/footer.blade.php --}}
<footer>
    <div class="footer-inner">
        <div class="footer-brand">
            <div class="footer-logo">🌿 Nadibunda</div>
            <p>Di tengah kesibukan sehari-hari, NadiBunda membantu ibu menemukan solusi mudah untuk memastikan si kecil mendapatkan asupan terbaik. Website ini dirancang khusus dengan pendekatan sederhana namun berbasis ilmu kebidanan dan kesehatan anak, sehingga mudah dipahami dan langsung bisa diterapkan di rumah.</p>
        </div>

        <div class="footer-col">
            <h4>Menu</h4>
            <a href="{{ route('video.index') }}">Video Edukasi</a>
            <a href="{{ route('gizi.index') }}">Gizi Seimbang</a>
            <a href="{{ route('resep.index') }}">Resep Sehat</a>
            <a href="{{ route('kalkulator.index') }}">Kalkulator Bayi</a>
        </div>

        <div class="footer-col">
            <h4>Topik</h4>
            <a href="{{ route('video.index') }}?cat=bayi">Gizi Bayi</a>
            <a href="{{ route('video.index') }}?cat=anak">Gizi Anak</a>
        </div>

        <div class="footer-col">
            <h4>Kontak</h4>
            <a href="mailto:info@gizisehat.id">info@gizisehat.id</a>
            <a href="#">Tentang Kami</a>
            <a href="#">Kebijakan Privasi</a>
        </div>
    </div>

    <div class="footer-bottom">
        <span>© {{ date('Y') }} NadiBunda. Untuk Kesehatan Indonesia.</span>
        <span>Referensi: WHO Growth Standards 2006 · Kemenkes RI</span>
    </div>
</footer>