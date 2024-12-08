<?php
// session_start() jika ada kebutuhan session, seperti untuk login
session_start();

// Include the database connection
include('dbconn.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="style.css" />
    <title>NumberOneHealth</title>
  </head>

  <body>
    <header>
    <div class="logo">
            <img src="Images/LogoNumberOneHealth.png" alt="NumberOneHealth Logo" />
            <a>Number<span>ONE</span>Health</a>
        </div>

        <nav class="navbar">
            <a href="#Home">Beranda</a>
            <a href="#Poli">Layanan Kami</a>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
    <a href="rekam_medis.php">
        Rekam Medis Pasien
    </a>
<?php endif; ?>
            <a href="#Dokter">Temukan Dokter</a>
            <a href="#Berita">Berita</a>
        </nav>

        <?php if(!isset($_SESSION['role'])): ?>
            <a href="login.php" class="btn">Login</a>
        <?php else: ?>
            <a href="logout.php" class="btn">Logout</a>
        <?php endif; ?>
    </header>
    <div id="whatsapp-icon">
      <a href="https://wa.me/+6285756967231" target="_blank" id="whatsapp-link">
        <span id="whatsapp-text">Bertanya via WA</span>
        <img src="Images/WhatsApp-Logo-Circle.png" alt="WhatsApp" id="whatsapp-logo">
      </a>
    </div>

    <section id="Home">
      <div class="Home-content">
        <div class="Home-text">
          <h1>Kesehatan Anda, prioritas utama kami</h1>
          <p>
            Kesehatan adalah prioritas utama. Kami berkomitmen untuk memberikan pelayanan terbaik, karena kesehatan Anda adalah yang terpenting.
          </p>
  
  <div class="Home-btn">
  <a href="appointment.php">
    <i class="fa-regular fa-calendar-days"></i>
    Buat Janji Temu
  </a>

  <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'user'): ?>
    <!-- Jika user sudah login -->
    <a href="rekam_medis_pasien.php" class="buatjanji-btn">
      <i class="fa-solid fa-check"></i> Lihat Rekam Medis Anda
    </a>
  <?php else: ?>
    <!-- Jika user belum login -->
    <a href="#" class="buatjanji-btn" onclick="showLoginMessage(event)">
      <i class="fa-solid fa-check"></i> Lihat Rekam Medis Anda
    </a>
  <?php endif; ?>
</div>

<!-- Pesan pop-up -->
<div id="login-message" class="login-message">
  <p><i class="fa-solid fa-info-circle"></i> Login untuk melihat rekam medis Anda.</p>
  <a href="login.php" class="login-link">Login di sini</a>
</div>

        </div>
        <div class="Home-img">
          <img src="Images/ParaDokter2.png" alt="" />
        </div>
      </div>
    </section>

    <section class="layanan">
      <div class="info-box">
        <div class="info-icon">
          <i class="fa-solid fa-hand-holding-medical"></i>
        </div>
        <div class="info-text">
          <strong>Pelayanan Medis Profesional</strong>
          <p>Tim dokter_berpengalaman dengan spesialisasi di berbagai bidang kesehatan siap memberikan perawatan terbaik untuk Anda</p>
        </div>
      </div>
      <div class="info-box">
        <div class="info-icon">
          <i class="fa-solid fa-laptop-medical"></i>
        </div>
        <div class="info-text">
          <strong>Fasilitas Modern dan Lengkap</strong>
          <p>Didukung oleh teknologi terkini dan fasilitas kesehatan berstandar internasional untuk kenyamanan dan keamanan Anda</p>
        </div>
      </div>
      <div class="info-box">
        <div class="info-icon">
          <i class="fa-solid fa-calendar-check"></i>
        </div>
        <div class="info-text">
          <strong>Layanan Janji Temu yang Mudah</strong>
          <p>Atur jadwal kunjungan Anda dengan mudah melalui platform online kami untuk pengalaman yang lebih praktis</p>
        </div>
      </div>
    </section>

    <section id="Tentang">
      <div class="tentang-img">
        <img src="Images/BangunanRS.jpeg" alt="" />
      </div>

      <div class="tentang-text">
        <h2>Tentang</br>
            Number One Health Hospital</h2>
        <p>
          Number One Health adalah rumah sakit yang berkomitmen untuk memberikan pelayanan kesehatan terbaik dengan dukungan tenaga medis profesional dan fasilitas medis terkini. Kami percaya bahwa kesehatan adalah prioritas utama, dan kami hadir untuk memastikan setiap pasien mendapatkan perawatan yang berkualitas, nyaman, dan aman.
        </p>
        <p>
          Dengan pengalaman bertahun-tahun dalam bidang kesehatan, kami menyediakan berbagai layanan medis yang lengkap, mulai dari pemeriksaan rutin hingga penanganan kondisi medis yang lebih kompleks. Rumah sakit kami dilengkapi dengan teknologi canggih dan fasilitas yang mendukung kebutuhan pasien dalam proses penyembuhan.
        </p>
        <div class="tentang-container">
          <div class="tentang-box box-no1">
            <strong>1000+</strong>
            <span>Pasien Kami</span>
          </div>
          <div class="tentang-box box-no2">
            <strong>24/7</strong>
            <span>Pelayanan Darurat</span>
          </div>
          <div class="tentang-box box-no3">
            <strong>230+</strong>
            <span>dokter_Berpengalaman</span>
          </div>
          <div class="tentang-box box-no4">
            <strong>400+</strong>
            <span>Kamar Tersedia</span>
          </div>
        </div>
      </div>
    </section>

    <section id="Poli">
      <div class="poli-heading">
        <div class="poli-heading-text">
          <strong>Pelayanan Medis Unggulan</strong>
          <h2>Poli Terbaik dengan Layanan Profesional untuk Kesehatan Anda</h2>
        </div>
      </div>

      <div class="poli-container">
        <div class="swiper mySwiperpoli">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="poli-box box-no1">
                <i class="fa-solid fa-tooth"></i>
                <strong>Poli Gigi dan Mulut</strong>
                <p>Menyediakan perawatan gigi, termasuk pembersihan, penambalan, pencabutan gigi, serta perawatan untuk masalah kesehatan mulut.</p>
                <a href="poli_gigi.php">Selengkapnya</a>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="poli-box box-no2">
                <i class="fa-solid fa-child"></i>
                <strong>Poli Anak </strong>
                <p>Memberikan layanan medis untuk anak-anak, mulai dari bayi hingga remaja, termasuk imunisasi, pemeriksaan tumbuh kembang, dan penanganan masalah kesehatan anak.</p>
                <a href="poli_anak.php">Selengkapnya</a>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="poli-box box-no3">
                <i class="fa-solid fa-person-pregnant"></i>
                <strong>Poli Kandungan</strong>
                <p>Fokus pada perawatan ibu hamil, persalinan, dan perawatan pasca melahirkan, serta layanan terkait kesehatan reproduksi wanita</p>
                <a href="poli_kandungan.php">Selengkapnya</a>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="poli-box box-no4">
                <i class="fa-solid fa-syringe"></i>
                <strong>Poli Bedah</strong>
                <p>Menyediakan layanan untuk pasien yang membutuhkan tindakan bedah, baik bedah umum maupun spesialisasi seperti bedah ortopedi, bedah saraf, dan lainnya.</p>
                <a href="poli_bedah.php">Selengkapnya</a>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="poli-box box-no5">
                <i class="fa-solid fa-heart-pulse"></i>
                <strong>Poli Jantung</strong>
                <p>Layanan untuk menangani gangguan jantung dan pembuluh darah, termasuk pemeriksaan seperti EKG, tes jantung, dan terapi untuk penyakit jantung.</p>
                <a href="poli_jantung.php">Selengkapnya</a>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="poli-box box-no6">
                <i class="fa-solid fa-brain"></i>
                <strong>Poli Saraf</strong>
                <p>Memberikan perawatan untuk gangguan saraf, termasuk konsultasi dan terapi untuk masalah neurologis seperti stroke, epilepsi, dan gangguan saraf lainnya.</p>
                <a href="poli_saraf.php">Selengkapnya</a>
              </div>
            </div>
          </div>
                    <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
      </div>
    </section>

    <section id="Dokter">
      <div class="dokter-heading">
        <h3>Temukan Dokter Terbaik untuk Kesehatan Anda</h3>
        <p>Cari dan buat janji dengan dokter_yang paling sesuai dengan kebutuhan kesehatan Anda. Kesehatan Anda adalah prioritas kami.</p>
      </div>

      <div class="dokter-container">

        <div class="swiper mySwiperdokter">
        <div class="swiper-wrapper">

          <div class="swiper-slide">
            <a href="dokter_jasmine.php">
            <div class="dokter-box">
              <div class="dokter-img">
               <img src="Images/team1.jpg" alt="">
             </div>
            <div class="dokter-text">
              <strong>Dr. Jasmine Cooper</strong>
              <span>Spesialis Anak</span>
            </div>
          </div>
          </a>
        </div>

                  <div class="swiper-slide">
                    <a href="dokter_david.php">
            <div class="dokter-box">
              <div class="dokter-img">
               <img src="Images/team2.jpg" alt="">
             </div>
            <div class="dokter-text">
              <strong>Dr. David Brown</strong>
              <span>Spesialis Bedah Ortopedi</span>
            </div>
          </div>
          </a>
        </div>

                  <div class="swiper-slide">
                    <a href="dokter_linda.php">
            <div class="dokter-box">
              <div class="dokter-img">
               <img src="Images/team3.jpg" alt="">
             </div>
            <div class="dokter-text">
              <strong>Dr. Linda Davis</strong>
              <span>Spesialis Dermatologi</span>
            </div>
          </div>
          </a>
        </div>

                  <div class="swiper-slide">
                    <a href="dokter_sarah.php">
            <div class="dokter-box">
              <div class="dokter-img">
               <img src="Images/team4.jpg" alt="">
             </div>
            <div class="dokter-text">
              <strong>Dr. Sarah Williams</strong>
              <span>Spesialis THT</span>
            </div>
          </div>
          </a>
        </div>

                  <div class="swiper-slide">
                    <a href="dokter_michael.php">
            <div class="dokter-box">
              <div class="dokter-img">
               <img src="Images/team5.jpg" alt="">
             </div>
            <div class="dokter-text">
              <strong>Dr. Michael Lee</strong>
              <span>Spesialis Penyakit Dalam</span>
            </div>
          </div>
        </a>
        </div>

                  <div class="swiper-slide">
                    <a href="dokter_jenifer.php">
            <div class="dokter-box">
              <div class="dokter-img">
               <img src="Images/team6.jpg" alt="">
             </div>
            <div class="dokter-text">
              <strong>Dr. Jennifer Clark</strong>
              <span>Spesialis Ginekologi</span>
            </div>
          </div>
          </a>
        </div>
        
      </div>
        <div class="swiper-button-prev-dokter"><i class="fa-solid fa-arrow-left"></i></div>
        <div class="swiper-button-next-dokter"><i class="fa-solid fa-arrow-right"></i></div>
        <div class="swiper-pagination"></div>
      </div>

    </div>
    </section>


    <section id="Berita">
          <div class="berita-heading">
            <h3>Simak Perkembangan Terbaru Seputar Kesehatan</h3>
          </div>
        </div>

        <div class="berita-kumpulan">
          <div class="berita-konten ">
            <div class="berita-img">
              <img src="Images/berita1.jpg" alt="">
            </div>
            <div class="berita-text">
              <div class="berita-judul">
                <strong>10 Perkembangan Teknologi Kesehatan di Tahun 2024</strong>
                <p>Pada tahun 2024, terobosan teknologi di bidang kesehatan telah membuka pintu menuju masa depan yang lebih cerah dan lebih sehat bagi masyarakat di seluruh dunia. Berbagai inovasi telah mengubah paradigma dalam diagnosis, pengobatan, dan manajemen penyakit, memungkinkan praktisi kesehatan untuk memberikan perawatan yang lebih efektif dan tepat sasaran. Mari kita telaah beberapa tren utama dalam teknologi kesehatan yang mencuat pada tahun 2024...</p>
                <a href="https://www.kompasiana.com/afnikurnia/65c9e31fde948f70151834a3/10-perkembangan-teknologi-kesehatan-di-tahun-2024">Baca Selengkapnya</a>
                <i class="fa-solid fa-arrow-right"></i>
              </div>
            </div>
          </div>

          <div class="berita-konten">
            <div class="berita-img">
              <img src="Images/berita22.jpg" alt="">
            </div>
            <div class="berita-text">
              <div class="berita-judul">
                <strong>Makin banyak kaum muda Indonesia kena serangan jantung, apa saja penyebabnya?</strong>
                <p>Jika Anda mengira bahwa orang yang rentan terkena serangan jantung adalah orang lanjut usia alias lansia, coba pikir lagi. Beberapa tahun belakangan, jumlah pasien jantung usia muda dilaporkan meningkat di Indonesia. Apa saja penyebabnya?...</p>
                <a href="https://www.tribunnews.com/internasional/2024/07/16/makin-banyak-kaum-muda-indonesia-kena-serangan-jantung-apa-saja-penyebabnya">Baca Selengkapnya</a>
                <i class="fa-solid fa-arrow-right"></i>
              </div>
            </div>
          </div>

            <div class="berita-konten">
            <div class="berita-img">
              <img src="Images/berita3.jpg" alt="">
            </div>
            <div class="berita-text">
              <div class="berita-judul">
                <strong>Daftar 6 Minuman yang Bisa Turunkan Kadar Gula Darah, Termasuk Kopi</strong>
                <p>Bukan cuma apa yang dimakan, minuman juga jelas berpengaruh pada kadar gula darah seseorang.
                  Saat ingin menurunkan kadar gula darah, sebaiknya menghindaei minuman manis, seperti soda, campuran jus buah, limun, dan teh manis atau bahkan minuman boba. Ada banyak minuman lain yang kaya manfaat dan berpengaruh pada fungsi metabolisme tubuh lebih baik....</p>
                <a href="https://health.detik.com/berita-detikhealth/d-7662446/daftar-6-minuman-yang-bisa-turunkan-kadar-gula-darah-termasuk-kopi">Baca Selengkapnya</a>
                <i class="fa-solid fa-arrow-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<footer>
  <div class="footer-top">
    <div class="footer-box">
      <div class="footer-grid">
        <div class="footer-logo-info">
          <h2>
            <img src="Images/LogoNumberOneHealth.png" alt="Logo" class="footer-logo"> 
            <a>Number<span>ONE</span>Health</a>
        </div>

        <!-- Email Section -->
        <div class="footer-contact">
          <i class="fa-regular fa-envelope-open"></i>
          <p>
             Email: NumberOneHealth@gmail.com<br>
             Inquiries: infoOneHealth@gmail.com
          </p>
        </div>

        <!-- Phone Section -->
        <div class="footer-contact">
          <i class="fa-solid fa-phone"></i>
          <p>
            Office Telephone: 0029129102320<br>
             Mobile: 000 2324 39493
          </p>
        </div>
        <div class="footer-contact">
          <i class="fa-solid fa-location-dot"></i>
          <p>
             Office Location:<br>
            Semangat Perjuangan No 100
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="social-icons">
      <a href="#"><i class="fa-brands fa-facebook"></i></a>
      <a href="#"><i class="fa-brands fa-twitter"></i></a>
      <a href="#"><i class="fa-brands fa-instagram"></i></a>
    </div>
    <p>© NumberOneHealth 2024 | All Rights Reserved by KelompokBiomedis</p>
  </div>
</footer>
    
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="script.js"></script>
  </body>
</html>
