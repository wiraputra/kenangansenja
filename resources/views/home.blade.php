<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kenangan Senja | Premium Coffee Experience</title>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- My Styles -->
    @vite(['resources/css/home.css', 'resources/js/script.js'])
  </head>
  <body>
    <!-- Navbar Start -->
    <nav class="navbar">
      <a href="#" class="navbar-logo">Kenangan<span>Senja</span>.</a>

      <div class="navbar-nav">
        <a href="#home">Home</a>
        <a href="#about">Tentang Kami</a>
        <a href="#menu">Menu</a>
        <a href="{{ route('login') }}">Login</a>
      </div>
    </nav>
    <!-- Navbar End -->

    <!-- Hero Section Start  -->
    <section class="hero" id="home">
      <main class="content">
        <h1>Mari Nikmati <br />Secangkir <span>Kopi</span></h1>
        <p>
          Nikmati kehangatan secangkir kopi terbaik yang kami sajikan khusus untuk Anda. Setiap tegukan membawa kenangan, setiap aroma membuat hari Anda lebih baik.
        </p>
        <a href="{{ route('login') }}" class="cta">Beli Sekarang!</a>
      </main>
    </section>
    <!-- Hero Section End -->

    <!-- About Section start -->
    <section id="about" class="about">
      <h2><span>Tentang</span> Kami</h2>

      <div class="row">
        <div class="about-img">
          <img src="{{ asset('img/tentangkami.jpg') }}" alt="Tentang Kami" />
        </div>
        <div class="content">
          <h3>Kenapa memilih kopi kami?</h3>
          <p>
            Di Kenangan Senja, kami hanya menggunakan biji kopi berkualitas tinggi yang dipilih secara teliti dari petani lokal terbaik. Kami percaya bahwa kopi bukan sekadar minuman, tetapi sebuah pengalaman sensorik.
          </p>
          <p>
            Dengan beragam pilihan profil sangrai dari berbagai daerah di Indonesia, Anda dapat menemukan karakter rasa yang paling sesuai dengan kepribadian Anda.
          </p>
        </div>
      </div>
    </section>
    <!-- About Section end-->

    <!-- Menu Section start -->
    <section id="menu" class="menu">
      <h2><span>Menu</span> Senja</h2>
      <p style="text-align: center; margin-bottom: 5rem; color: var(--text-muted);">
        Dikurasi secara khusus oleh barista ahli kami untuk memberikan pengalaman rasa yang tak terlupakan.
      </p>

      <div class="row">
        <div class="menu-card">
          <img src="{{ asset('img/espresso_remastered.png') }}" alt="Espresso" />
          <h3 class="menu-card-title">Pure Espresso</h3>
          <p class="menu-card-price">Rp 15.000</p>
        </div>
        <div class="menu-card">
          <img src="{{ asset('img/latte_remastered.png') }}" alt="Latte" />
          <h3 class="menu-card-title">Velvet Latte</h3>
          <p class="menu-card-price">Rp 25.000</p>
        </div>
        <div class="menu-card">
          <img src="{{ asset('img/slide1.jpg') }}" alt="Cappuccino" />
          <h3 class="menu-card-title">Classic Cappuccino</h3>
          <p class="menu-card-price">Rp 22.000</p>
        </div>
      </div>
    </section>
    <!-- Menu Section end -->

    <!-- Footer start -->
    <footer>
      <div class="socials">
        <a href="#"><i data-feather="instagram"></i></a>
        <a href="#"><i data-feather="youtube"></i></a>
        <a href="#"><i data-feather="facebook"></i></a>
      </div>

      <div class="links">
        <a href="#home">Home</a>
        <a href="#about">Tentang Kami</a>
        <a href="#menu">Menu</a>
        <a href="{{ route('login') }}">Login</a>
      </div>

      <div class="credit">
        <p>Created by <a href="#">PBL Last Hope</a>. &copy; 2024 Kenangan Senja</p>
      </div>
    </footer>
    <!-- Footer end -->

    <!-- Feather Icons -->
    <script>
      feather.replace();
    </script>
    
    <script>
        history.pushState(null, '', location.href);
        window.onpopstate = function() {
            history.pushState(null, '', location.href);
        };
    </script>
  </body>
</html>
