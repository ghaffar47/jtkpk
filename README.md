## Portal Juruteknik Komputer Negeri Perak (JTKPK)

![Versi Template](http://img.shields.io/badge/Versi-v1.0-green.svg)

Portal bersepadu Juruteknik Komputer (FT) & Platform utama bagi menguruskan pelbagai maklumat berkaitan dengan tugasan FT. :+1:

[![Antaramuka Dashboard](https://image.ibb.co/hdra0k/jtkpk_1.jpg)](https://image.ibb.co/hdra0k/jtkpk_1.jpg)
[![Antaramuka Dashboard](https://image.ibb.co/d11KRQ/jtkpk_2.jpg)](https://image.ibb.co/d11KRQ/jtkpk_2.jpg)
[![Antaramuka Dashboard](https://image.ibb.co/hJ3cD5/jtkpk_3.jpg)](https://image.ibb.co/hJ3cD5/jtkpk_3.jpg)

### **Nota Ringkas:**

#### Repository ini mengandungi projek sumber terbuka *Framework Laravel (PHP)*. Sistem ini mengandungi modul-modul yang digunapakai dalam menguruskan semua maklumat berkaitan dengan tugasan FT. Sistem ini telah diubahsuai mengikut keperluan dari masa ke semasa.

**Modul-Modul :**

* Modul Pendaftaran Pengguna bagi sistem *(full authentication)*.
* Maklumat JPN, PPD, dan Sekolah di dalam Negeri PERAK sahaja (buat masa ini).
* Dimurnikan lagi dengan Themes (Kredit [@putera](https://github.com/putera)) yang sangat cantik dan fluid untuk mobile.
* Modul Development Team - Pengurusan kumpulan Development Team, projek.
* Modul SMART Team - Pengurusan kumpulan SMART Team serta aktiviti.
* Aktiviti Ad-Hoc (Aktiviti yang dijalankan yang tidak melibatkan kumpulan SMART Team)
* Modul FORUM
* Modul Log Tugasan & Senarai Semak Harian - Menguruskan log tugasan & senarai semak harian
* Modul Aduan Kerosakan Peralatan ICT (AKP) - Menguruskan aduan kerosakan peralatan ICT

**Laporan :**

* Laporan Bulanan Aduan Kerosakan Peralatan ICT (AKP)
* Laporan Bulanan Log Tugasan & Senarai Semak Harian
* Laporan Bulanan Kelajuan Talian Internet 1BestariNet *(Speedtest)*

**Komponen yang telah dimasukkan antaranya ialah :**

* Facebook Graph API
* Twitter API
* DOMPDF (Untuk generate fail PDF)
* Google reCAPTCHA (Untuk mengelakkan SPAM dan ABUSE sistem)
* Cloudinary API (Upload gambar secara PERCUMA)
* dan akan ditambah dari masa ke semasa mengikut kepada keperluan.

## Cloning & Cara Pemasangan

> Sila install perisian Git (https://git-scm.com) & Composer (https://getcomposer.org) untuk proses cloning dan ikuti langkah di bawah :

**Langkah 1 :** Clone/Muatturun sos kod ini
```
git clone https://github.com/putera/jtkpk.git
```

**Langkah 2 :** Kemaskini Composer
```
composer update
```

**Langkah 3 :** Konfigurasi Database & Portal

*.ENV*

```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=<NAMA_DATABASE_ANDA>
DB_USERNAME=<DATABASE_USER>
DB_PASSWORD=<DATABASE_PASSWORD>
```

*config/app.php*

```
'debug' => env('APP_DEBUG', false),
'url' => env('APP_URL', 'URL_SEBENAR_WEB_ANDA'),
```

**Langkah 4 :** Migrate Database (Wujudkan table-table dalam database)
```
php artisan migrate
```

**Langkah 5 :** Seed Database (Masukkan maklumat data asas ke dalam database)
```
php artisan db:seed
```

** Untuk pengguna macOS/Ubuntu dan Linux, Buka *terminal* dan tukar *permission* untuk *write access* folder berkenaan
```
sudo chmod -R 777 storage/
sudo chmod -R 777 public/devteam/kertas-kerja/
sudo chmod -R 777 bootstrap/
```

**Langkah 6 :** Run Sistem
```
php artisan serve
```

```
Layari : http://localhost:8000
```

Itu sahaja ! Mudah kan ?

**Pengguna & Kata Laluan Administrator *default* adalah :**
```
E-mel : admin@jtkpk.dev
Kata Laluan : password
```

Sebarang masalah boleh berhubung terus dengan saudara Zulkifli Mohamed [(@putera)](https://github.com/putera). Terima kasih.

## Contribute & Penambahbaikan Portal JTKPK

Untuk menjadi salah seorang daripada penyumbang atau contributor dalam penambahbaikan portal JTKPK ini, anda boleh *fork* repositori ini dan sila *Pull Request* sos kod anda untuk diuji sebelum dimerge kedalam master sistem. Terima kasih.
