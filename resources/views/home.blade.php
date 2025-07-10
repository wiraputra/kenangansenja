<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kenangan Senja</title>

    <!-- Fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- My Styles -->
    @vite(['resources/css/home.css','resources/js/script.js'])
  </head>
  <body>
    <!-- Navbar Start -->
    <nav class="navbar">
      <a href="#" class="navbar-logo">Kenangan<span>Senja</span>.</a>

      <div class="navbar-nav">
        <a href="#">Home</a>
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
        <p >
          Nikmati kehangatan secangkir kopi terbaik yang kami sajikan khusus untuk Anda. Setiap tegukan membawa kenangan, setiap aroma membuat hari Anda lebih baik. Temukan rasa autentik dan hangatnya kopi kami hanya di Kenangan Senja.
        </p>
        <a href="{{ route('login') }}" class="cta">Beli Sekarang!</a>
        <!-- cta = call to action -->
      </main>
    </section>
    <!-- Hero Section End -->

    <!-- About Section start -->
    <section id="about" class="about">
      <h2><span>Tentang</span> Kami</h2>

      <div class="row">
        <div class="about-img">
          <img src="img/tentang-kami.jpg" alt="Tentang Kami" />
        </div>
        <div class="content">
          <h3>Kenapa memilih kopi kami?</h3>
          <p>
            Di Kenangan Senja, kami hanya menggunakan biji kopi berkualitas tinggi yang dipilih secara teliti. Kami percaya bahwa kopi bukan sekadar minuman, tetapi sebuah pengalaman yang membawa kedamaian dan kebahagiaan dalam setiap tegukan.
          </p>
          <p>
            Dengan beragam pilihan kopi dari berbagai daerah, Anda dapat menemukan kopi yang sesuai dengan selera Anda. Dapatkan sensasi berbeda setiap kali mencicipi kopi kami yang dibuat dengan penuh cinta dan keahlian.
          </p>
        </div>
      </div>
    </section>
    <!-- About Section end-->

    <!-- Menu Section start -->
    <section id="menu" class="menu">
      <h2><span>Menu</span> Senja</h2>
      <p>
        Kami menyajikan berbagai jenis kopi dengan rasa yang berbeda untuk setiap preferensi. Dari espresso yang kuat hingga kopi susu yang lembut, setiap menu kami dibuat untuk memenuhi selera kopi Anda.
      </p>

      <div class="row">
        <div class="menu-card">
          <img src="img/menu1.jpg" alt="espresso" class="menu-card-image" />
          <h3 class="menu-card-title">- Espresso</h3>
          <p class="menu-card-price">Price: 15K</p>
        </div>
        <div class="menu-card">
          <img src="img/menu1.jpg" alt="espresso" class="menu-card-image" />
          <h3 class="menu-card-title">- Espresso</h3>
          <p class="menu-card-price">Price: 15K</p>
        </div>
        <div class="menu-card">
          <img src="img/menu1.jpg" alt="espresso" class="menu-card-image" />
          <h3 class="menu-card-title">- Espresso</h3>
          <p class="menu-card-price">Price: 15K</p>
        </div>
        <div class="menu-card">
          <img src="img/menu1.jpg" alt="espresso" class="menu-card-image" />
          <h3 class="menu-card-title">- Espresso</h3>
          <p class="menu-card-price">Price: 15K</p>
        </div>
        <div class="menu-card">
          <img src="img/menu1.jpg" alt="espresso" class="menu-card-image" />
          <h3 class="menu-card-title">- Espresso</h3>
          <p class="menu-card-price">Price: 15K</p>
        </div>
      </div>
    </section>
    <!-- Menu Section end -->

    <!-- Footer start -->
    <footer>
      <div class="socials">
        <a href="https://www.instagram.com/politeknik_negeri_bali?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="><i data-feather="instagram" style="width:36px;height:36px;"></i></a>
        <a href="https://www.youtube.com/@sandhikagalihWPU"><i data-feather="youtube" style="width:36px;height:36px;"></i></a>
        <a href="https://web.facebook.com/MicrosoftIndonesia"><i data-feather="facebook" style="width:36px;height:36px;"></i></a>
      </div>

      <div class="links">
        <a href="#home">Home</a>
        <a href="#about">Tentang Kami</a>
        <a href="#menu">Menu</a>
        <a href="#contact">Kontak</a>
      </div>

      <div class="credit">
        <p>Created by <a href="">PBL Last Hope</a>. | &copy; 2024</p>
      </div>
    </footer>
    <!-- Footer end -->

    <!-- Feather Icons -->
    <script>
      feather.replace();
    </script>
  </body>
<script>
        // Fungsi untuk mencegah pengguna kembali ke halaman sebelumnya
        history.pushState(null, '', location.href);
        window.onpopstate = function() {
            history.pushState(null, '', location.href);
        };
    </script>
</html>
<!-- Prevent browser from going back to the login page -->
