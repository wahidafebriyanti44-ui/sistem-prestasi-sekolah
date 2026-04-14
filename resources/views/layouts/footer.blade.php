<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <a href="{{ route('home') }}" class="footer-brand">
                    <i class="bi bi-trophy-fill me-2"></i>SIPRES
                </a>
                <p class="footer-description">
                    Sistem Informasi Prestasi Siswa - Platform digital untuk mencatat, mempublikasi, dan mengapresiasi prestasi siswa di seluruh Indonesia.
                </p>
                <div class="social-links">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-title">Menu</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right me-2"></i>Beranda</a></li>
                    <li><a href="{{ route('prestasi.index') }}"><i class="bi bi-chevron-right me-2"></i>Prestasi</a></li>
                    <li><a href="{{ route('sekolah.index') }}"><i class="bi bi-chevron-right me-2"></i>Sekolah</a></li>
                    <li><a href="#tentang"><i class="bi bi-chevron-right me-2"></i>Tentang</a></li>
                </ul>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Layanan</h5>
                <ul class="footer-links">
                    <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Daftarkan Sekolah</a></li>
                    <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Panduan Penggunaan</a></li>
                    <li><a href="#"><i class="bi bi-chevron-right me-2"></i>FAQ</a></li>
                    <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Bantuan</a></li>
                </ul>
            </div>
            
            <div class="col-lg-3">
                <h5 class="footer-title">Kontak</h5>
                <ul class="footer-links">
                    <li>
                        <i class="bi bi-geo-alt-fill me-2"></i>
                        Jl. Pendidikan No. 123, Jakarta
                    </li>
                    <li>
                        <i class="bi bi-telephone-fill me-2"></i>
                        (021) 1234-5678
                    </li>
                    <li>
                        <i class="bi bi-envelope-fill me-2"></i>
                        info@sipres.com
                    </li>
                    <li>
                        <i class="bi bi-whatsapp me-2"></i>
                        +62 812-3456-7890
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p class="mb-0">
                © {{ date('Y') }} SIPRES - Sistem Informasi Prestasi Siswa. 
                Hak Cipta Dilindungi.
            </p>
        </div>
    </div>
</footer>