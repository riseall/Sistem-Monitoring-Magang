# 📌 Sistem Monitoring Magang Mahasiswa

![Laravel](https://img.shields.io/badge/Laravel-11-red?style=flat&logo=laravel)
![Vue.js](https://img.shields.io/badge/Vue.js-3-41B883?style=flat&logo=vue.js)
![Tailwind CSS](https://img.shields.io/badge/TailwindCSS-3-06B6D4?style=flat&logo=tailwindcss)
![MySQL](https://img.shields.io/badge/MySQL-8-4479A1?style=flat&logo=mysql)
![Docker](https://img.shields.io/badge/Docker-20.10.7-blue?style=flat&logo=docker)

Sistem Monitoring Magang Mahasiswa adalah platform berbasis web yang dikembangkan menggunakan **Laravel, Vue.js, dan Tailwind CSS** untuk memantau kegiatan magang mahasiswa secara efisien. Sistem ini memungkinkan mahasiswa, dosen pembimbing, dan pihak perusahaan untuk berinteraksi dan mengelola laporan magang dengan mudah.

## 🚀 Fitur Utama
✅ **Manajemen Pengguna**: Admin, mahasiswa, dan dosen pembimbing memiliki akses sesuai dengan peran mereka.  
✅ **Pengelolaan Laporan Magang**: Mahasiswa dapat mengunggah laporan harian, mingguan, dan akhir magang.  
✅ **Monitoring & Evaluasi**: Dosen pembimbing dapat memberikan feedback dan evaluasi terhadap laporan mahasiswa.  
✅ **Notifikasi & Dashboard Interaktif**: Informasi terbaru tentang magang dapat diakses dalam satu tampilan dashboard.  

---

## 🛠️ Teknologi yang Digunakan
- **Backend**: Laravel 11  
- **Frontend**: Vue.js 3, Tailwind CSS  
- **Database**: MySQL 8  
- **Containerization**: Docker & Docker Compose  
- **Authentication**: Laravel Sanctum  

---

## 🔧 Instalasi & Menjalankan Proyek dengan Docker
Ikuti langkah-langkah berikut untuk menjalankan proyek menggunakan **Docker**.

### **1. Clone Repository**
```bash
git clone https://github.com/riseall/Sistem-Monitoring-Magang.git
cd Sistem-Monitoring-Magang
```

### **2. Konfigurasi File `.env`**
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Sesuaikan pengaturan database:
```dotenv
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=airmonitoring
DB_USERNAME=root
DB_PASSWORD=root
```

### **3. Build & Jalankan Docker Containers**
Jalankan perintah berikut untuk membangun dan menjalankan container:
```bash
docker-compose up -d --build
```
Perintah ini akan menjalankan beberapa container, termasuk:
- **Laravel (PHP)**
- **MySQL Database**
- **Vue.js Frontend**
- **Nginx Web Server**

### **4. Install Dependencies**
Setelah container berjalan, masuk ke container Laravel:
```bash
docker exec -it sistem-magang-app bash
```
Lalu jalankan:
```bash
composer install
npm install
npm run build
```

### **5. Generate Key & Migrasi Database**
```bash
php artisan key:generate
php artisan migrate --seed
```

### **6. Akses Aplikasi**
Aplikasi dapat diakses melalui:
- **Frontend**: `http://localhost:5173`
- **Backend API**: `http://localhost:8000`
- **phpMyAdmin (Opsional)**: `http://localhost:8080` (jika diaktifkan dalam `docker-compose.yml`)

---

## 📸 Tampilan
🚀 **Tampilan Website**

![dash log](https://github.com/user-attachments/assets/e103ca64-97c4-42c8-9c70-7cf32500743a)
![dash adm](https://github.com/user-attachments/assets/dd4761af-eb36-44ca-bac3-7c7c325094bf)
![dash mgng](https://github.com/user-attachments/assets/e18d62ff-ab08-423e-89ad-2ea3c6bc6e32)
![dash abs](https://github.com/user-attachments/assets/326b5648-bb61-4ad3-a465-046067669de9)

🚀 **Tampilan WebAPP**

![mob log](https://github.com/user-attachments/assets/1b49cfd3-3c55-4401-94b8-852de3b0a1c5)
![mob reg](https://github.com/user-attachments/assets/2c2d1091-9346-4f5b-abe5-20d935052da4)
![mob lok](https://github.com/user-attachments/assets/ee828941-1054-4dd2-a7de-893a336cdebd)
![mob dt mhs2](https://github.com/user-attachments/assets/72266aa2-44d2-47fd-908a-06e8c7fad683)
![mob dt mhs1](https://github.com/user-attachments/assets/5c926def-0a06-4359-bc39-0b370f1bd58e)
![mob dsh](https://github.com/user-attachments/assets/6f963ae4-88dc-45cb-a3ca-8963d081d856)
![mob abs](https://github.com/user-attachments/assets/46a024c2-cff3-48bd-8875-02fffebeec21)
![mob rwyt](https://github.com/user-attachments/assets/595ac660-49b1-402d-8507-c05efbf67439)

---

## 🛠️ Pengelolaan Akun
| Role | Email | Password |
|------|--------|---------|
| Admin | admin@example.com | password |
| Dosen | dosen@example.com | password |
| Mahasiswa | mahasiswa@example.com | password |

---

## 📜 Lisensi
Proyek ini dirilis di bawah lisensi **MIT**. Silakan cek file [LICENSE](LICENSE) untuk informasi lebih lanjut.

---

## 🤝 Kontribusi
Kontribusi sangat terbuka! Jika ingin berkontribusi:
1. Fork repo ini
2. Buat branch baru (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -m "Menambahkan fitur baru"`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request 🚀

---

## 📬 Kontak
📌 **Developer:** [Rizal Nugroho](https://github.com/riseall)  
📧 **Email:** rizalnug2@gmail.com  

---
⭐ **Jangan lupa berikan star pada repositori ini jika bermanfaat!** ⭐
