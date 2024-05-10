<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
</p>


## Apa itu laravel?

Laravel adalah sebuah framework PHP yang sangat populer saat ini. sama seperti halnya codeigniter jika teman-teman sudah pernah mendengar tentang codeigniter, laravel dan codeigniter sama-sama merupakan framework atau kerangka kerja PHP yang dibuat untuk mempermudah para developer atau programmer dalam membangun sistem/aplikasi yang berukuran kecil, bahkan sampai sekala besar.


## Keterangan Project yang saya buat

* Klasifikasi Surat: Surat Masuk dan Disposisi
* Jenis Surat: Surat resmi atau formal yang diterima oleh institusi atau organisasi.
* Sumber Surat: Surat masuk diterima dari pihak eksternal, seperti mitra bisnis, institusi pemerintah, atau individu.
* Isi Surat Masuk: Detail isi surat, termasuk pengirim, tanggal masuk, nomor surat, perihal, lampiran (jika ada), dan informasi penting lainnya.
* Proses Disposisi: Setelah surat masuk diverifikasi dan diterima, proses disposisi dilakukan. Disposisi mencakup penugasan, tanggapan, atau tindak lanjut terkait surat yang diterima.
* Penyimpanan Surat: Surat masuk dan disposisi disimpan secara terpisah dengan klasifikasi yang jelas untuk memudahkan pencarian dan pengelolaan arsip.
* Pengelolaan Arsip Digital: Arsip surat masuk dan disposisi dikelola secara digital melalui sistem pengarsipan elektronik. Setiap surat memiliki metadata yang mencakup informasi penting seperti nomor surat, tanggal, jenis disposisi, dan status tindak lanjut.
* Ketentuan Retensi: Surat masuk dan disposisi diarsipkan sesuai dengan kebijakan retensi yang berlaku, untuk memastikan kepatuhan dan ketersediaan informasi yang diperlukan pada masa yang akan datang.
* Aksesibilitas: Pengguna yang berwenang memiliki akses terhadap arsip surat masuk dan disposisi sesuai dengan kebutuhan tugas dan tanggung jawab mereka.
* Keamanan: Sistem pengarsipan digital dilengkapi dengan kontrol keamanan yang ketat, termasuk otorisasi akses, enkripsi data, dan pemantauan aktivitas untuk menjaga integritas dan kerahasiaan informasi.
## Installation

anda bisa menginstal project dengan cara berikut:

```Bash
  Run git clone https://github.com/natzsixn/tugas-UPK.git
  Run composer install
  Run cp .env.example .env
  Run php artisan key:generate
  Run php artisan migrate:fresh --seed
  Run php artisan serve
  Go to link localhost:8000
```
    
## Features

- login (user & admin)
- create Pegawai / karyawan (admin)
- disposisi & mail(user & admin)


## Tables database

berikut adalah tabel dan isi seeder yang ada di database **test**

#### Tables Users

| id | Username | Password | Fullname |Level | 
| :-------- | :------- |  :-------  | :------- | :------- |
| `1` | `Natanael` | admin | Natanael Ben Iriyanto | admin |
| `2` | `Chika` | user1 | chika | user |
| `3` | `layla` | user | layla | user |


#### type Surat

| id | mail_Type     |
| :-------- | :------- |
| `1`      | `Surat pribadi` |
| `2`      | `Surat dinas` |
| `3`      | `Surat niaga` |
| `4`      | `Surat sosial` |
| `5`      | `Surat edaran` |
| `6`      | `Surat keputusan` |
| `7`      | `Surat pengumuman` |
| `8`      | `Surat perjanjian` |

#### mail

| id | incoming_at | mail_code | mail_date | mail_from | mail_to | mail_subject | description| file_upload | mail_typeid | userid |
| :-------- | :------- | :-------  | :------- | :-------  | :------- | :------- | :------- | :-------  | :-------  | :------- | 
| belum di isi | belum di isi| belum di isi | belum di isi | belum di isi | belum di isi | belum di isi | belum di isi | belum di isi | belum di isi | belum di isi |


#### desposisi

| id | desposition_at | reply_at | description | notification | mail_id | user_id | status|
| :-------- | :------- | :-------  | :------- | :-------- | :------- | :-------  | :------- |  
| belum di isi | belum di isi| belum di isi | belum di isi | belum di isi | belum di isi | belum di isi | belum di isi | 



## Authors

- [@Natanael Ben Iriyanto](https://github.com/natzsixn)
- @Chika
- @Layla
- @Anisa


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
