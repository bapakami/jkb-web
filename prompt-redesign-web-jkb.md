# Prompt Redesign Website JKB (jkb.co.id) — Framework Laravel

## Konteks Proyek
Redesign total website perusahaan **CV Jati Kencana Beton (JKB)**, produsen beton ready mix, beton pracetak/precast, dan material split di Jawa Tengah, berdiri sejak 1980 dan bersertifikasi ISO 9001:2015. Website saat ini dibangun dengan **Drupal**, akan dimigrasi penuh ke **Laravel** (versi terbaru), dengan struktur konten dan informasi bisnis dipertahankan, namun tampilan, performa, dan struktur kode dibangun ulang dari nol agar lebih modern, cepat, dan mudah dikelola.

## Tujuan
- Membangun ulang jkb.co.id menggunakan Laravel sebagai backend/CMS custom.
- Mempertahankan identitas visual: **warna kuning** sebagai warna utama brand, dan **logo perusahaan yang sama** (tidak diganti).
- Meningkatkan kecepatan load, SEO, dan kemudahan update konten dibanding versi Drupal saat ini.
- Tampilan lebih modern, bersih, profesional, dan mencerminkan citra "Kokoh Berkualitas".

## Stack Teknis
- **Backend**: Laravel (versi terbaru/LTS)
- **Frontend**: Blade templating + Tailwind CSS (atau Bootstrap, sesuaikan preferensi), Alpine.js untuk interaktivitas ringan
- **Database**: MySQL/MariaDB
- **Admin Panel**: Laravel-based CMS custom atau Filament/Nova untuk kelola produk, berita, karir, proyek
- **Hosting**: sesuaikan dengan hosting existing (cPanel/VPS)
- **Form & Integrasi**: WhatsApp API link untuk CTA "Konsultasi Gratis" dan "Hubungi Kami", form kontak dengan validasi

## Identitas Visual
- **Warna utama**: kuning brand JKB, kombinasikan dengan abu-abu gelap sebagai warna sekunder (dipakai di teks logo "JKB" dan tagline)
  - Kuning: `#FFC72C` (sesuaikan dengan warna asli file logo)
  - Abu gelap: `#6D6E71` (sesuaikan dengan warna asli file logo)
  - Putih sebagai background utama untuk menjaga kontras
- **Logo**: gunakan file logo asli perusahaan (`logo_dengan_tulisan.png`) apa adanya, jangan didesain ulang
  - Deskripsi logo: bentuk kelopak kuning menyerupai bunga/matahari dengan siluet rumah abu-abu di tengahnya (melambangkan bangunan/konstruksi), di sampingnya teks "JKB" besar berwarna abu-abu, dengan tagline "KOKOH BERKUALITAS" di bawahnya
  - Simpan logo di `public/images/logo.png` atau `resources/images/logo.png`, gunakan sebagai favicon (crop bagian ikon kelopak saja) dan logo header/footer (versi lengkap dengan tulisan)
- **Tipografi**: font tegas, mudah dibaca, kesan industrial-modern, senada dengan gaya huruf logo JKB (bold, kokoh)
- **Gaya visual**: solid, kokoh, terpercaya — foto proyek nyata, ikon teknis (GPS, timbangan, ISO), bukan ilustrasi kartun

## Catatan Penggunaan Prompt
File ini ditulis untuk digunakan sebagai instruksi/context ke AI coding assistant (misalnya opencode) saat membangun proyek Laravel dari awal. Saat memberikan prompt ke tool tersebut:
- Sertakan file logo asli sebagai referensi aset visual
- Minta AI membuat struktur proyek Laravel standar (routes, controllers, models, migrations, views/Blade) sesuai sitemap di bawah sebelum menulis kode
- Minta AI membangun bertahap: struktur dasar & layout dulu, baru per halaman/fitur, agar mudah direview satu per satu

## Struktur Halaman (Sitemap)
1. **Beranda**
   - Hero section dengan headline "JKB Kokoh Berkualitas — Beton Ready Mix, Beton Pracetak/Precast, Batu Split Jawa Tengah" + CTA WhatsApp "Konsultasi Gratis"
   - Section keunggulan: Jaminan Kualitas, Jaminan Material, Jangkauan Luas, Jaminan Teknologi, Jaminan Armada
   - Section "Tepat Waktu, Kunci Kekuatan Beton" (GPS Tracking, Control Room, koordinasi armada)
   - Section sertifikasi ISO 9001:2015
   - Section pengalaman "Lebih Dari 40 Tahun" dengan 3 kategori proyek: Komersial & Perumahan, Industri, Infrastruktur
   - Section Produk Pilihan: Split, Beton Ready Mix, Beton Pracetak/Precast (masing-masing dengan CTA "Hubungi Kami" dan "Detail Produk")
   - Peta sebaran cabang di Jawa Tengah: Semarang, Ungaran, Batang, Purwokerto, Satelite Muntilan, Satelite KITB Krengseng
   - Section klien & mitra (logo grid)
   - Testimoni klien
   - Footer: jam kerja, kontak (telepon, WhatsApp, email), sosial media, sitemap ringkas

2. **Tentang Kami** — sejarah perusahaan, visi misi, sertifikasi ISO

3. **Produk** (dengan sub-kategori)
   - **Split**: Agregat, Batu Split, Batu Belah, LPA, LPB, Abu Batu, M-Sand, Pasir Alam
   - **Beton Ready Mix**
     - Non Struktural: K.100–K200, Beton Berpori, Mortar Foam, Beton Ringan/Apung
     - Struktural: K.225–K.500, Beton Suhu, Beton Open Traffic (Percepatan), Beton Dengan Kepadatan Tinggi, Beton Tahan Sulphur dan Clouride, Beton Dengan Kekuatan Sangat Tinggi
   - **Beton Pracetak/Precast**: Box Culvert, U-Ditch & Tutupnya, Panel Pagar & Kolom Pagar, Panel Dinding Irigasi, Paving Block, Grass Block, Kansteen, Batako
   - Setiap produk punya halaman detail sendiri (spesifikasi, kegunaan, CTA order via WhatsApp)

4. **Proyek** — showcase proyek yang telah dikerjakan (galeri foto/video)

5. **Berita** — blog/artikel perusahaan

6. **Karir** — lowongan kerja aktif

7. **Kontak** — form kontak, peta lokasi cabang, info kontak lengkap

8. **Tahukah Anda?** — konten edukasi/insight video seputar beton dan konstruksi

9. **Halaman Cabang** — detail per cabang (Semarang, Ungaran, Batang, Purwokerto, Muntilan, Krengseng)

## Fitur Fungsional
- CMS admin untuk kelola: produk, kategori produk, proyek, berita, lowongan karir, data cabang, testimoni, logo klien/mitra
- SEO-friendly URL structure (slug) dan meta tag dinamis per halaman/produk
- Integrasi tombol WhatsApp floating/CTA di semua halaman produk
- Responsive penuh (mobile-first), karena banyak calon klien akses dari HP
- Optimasi gambar (lazy load, compress) mengingat banyak foto proyek dan produk
- Formulir kontak dengan validasi dan notifikasi email
- Struktur data terstruktur (schema.org) untuk local business & produk agar SEO lebih optimal
- Sitemap XML otomatis

## Yang Perlu Dipertahankan dari Web Lama
- Nomor telepon, WhatsApp, email, jam operasional
- Struktur kategori produk (jangan diubah nama/kategorinya agar tidak merusak SEO existing)
- Daftar cabang dan wilayah operasional
- Sertifikasi ISO 9001:2015 sebagai trust signal
- Tautan sosial media: Instagram, Facebook, YouTube

## Catatan Tambahan
- Prioritaskan kecepatan loading dibanding versi Drupal saat ini yang cenderung berat
- Desain harus tetap terasa sebagai brand yang sama (kontinuitas visual), bukan rebranding total — hanya modernisasi
