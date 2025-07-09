# 🌐 Website Sederhana dengan PHP

Ini adalah repositori untuk proyek **website sederhana** yang dibangun menggunakan bahasa pemrograman **PHP**. Proyek ini berfungsi sebagai contoh website dinamis dasar, cocok untuk portofolio, halaman profil, atau situs web bisnis kecil.

---

## 📝 Deskripsi Proyek

Proyek ini mendemonstrasikan pembuatan website fungsional menggunakan **PHP** untuk logika sisi server. Struktur proyek ini memanfaatkan file-file PHP terpisah seperti `header.php` dan `footer.php` agar bagian-bagian halaman dapat digunakan kembali di banyak halaman, sesuai prinsip **DRY** (Don't Repeat Yourself).

### Kemungkinan halaman yang tersedia:
- `index.php` — Halaman Utama  
- `about.php` — Tentang Kami  
- `services.php` — Layanan  
- `contact.php` — Kontak  

---

## ✨ Fitur Utama

- **Struktur Modular**  
  Menggunakan `include` atau `require` di PHP untuk menyusun halaman dari komponen yang dapat digunakan kembali seperti header, footer, dan navigasi.

- **Navigasi Multi-Halaman**  
  Sistem navigasi antar halaman yang intuitif dan konsisten.

- **Desain Responsif**  
  Dibuat menggunakan HTML dan CSS agar tampilan tetap baik di berbagai perangkat (desktop & mobile).

- **Dasar Pengembangan Lanjutan**  
  Kode ini dapat dikembangkan lebih lanjut dengan:
  - Integrasi ke database (mis. MySQL)
  - Penambahan CMS
  - Sistem login pengguna
  - Formulir kontak yang dinamis

---

## 🛠️ Teknologi yang Digunakan

- **Backend**: PHP  
- **Frontend**: HTML, CSS  
- **Server Web (Lingkungan Lokal)**: Apache atau Nginx (melalui XAMPP, WAMP, MAMP)

---

## ⚙️ Instalasi dan Penggunaan

1. **Instal Server Lokal**
   - Unduh dan instal [XAMPP](https://www.apachefriends.org/) atau alternatif lainnya seperti WAMP/MAMP.
   
2. **Clone Repositori**
   ```bash
   git clone https://github.com/chardinal/website-with-php.git

## 📂 Struktur Repositori

website-with-php/
├── about.php          # Halaman Tentang Kami
├── contact.php        # Halaman Kontak
├── css/               # Direktori styling
│   └── style.css
├── images/            # Aset gambar
├── includes/          # Komponen reusable
│   ├── footer.php
│   └── header.php
├── index.php          # Halaman Utama
├── services.php       # Halaman Layanan
└── README.md          # Dokumentasi proyek
