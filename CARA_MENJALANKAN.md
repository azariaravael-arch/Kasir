# ▶️ Cara Menjalankan Sistem Kasir POS

## 🚀 Quick Start (5 Menit)

### **Langkah 1: Setup Database**
```bash
php artisan migrate:fresh --seed
```
✅ Database siap dengan test data

### **Langkah 2: Jalankan Server**
```bash
php artisan serve
```
✅ Server berjalan di: **http://localhost:8000**

### **Langkah 3: Login**

Akses URL di browser: **http://localhost:8000**

**Pilih salah satu user:**

#### **Option A: Login Sebagai Admin**
```
Email: admin@example.com
Password: password
```
👉 Akses penuh: Dashboard, POS, Manajemen Produk, Laporan

#### **Option B: Login Sebagai Kasir**
```
Email: kasir@example.com
Password: password
```
👉 Akses terbatas: Dashboard, POS (transaksi saja)

---

## 📍 URL & Fitur untuk Setiap Role

### **👨‍💼 ADMIN (Full Access)**

| URL | Fitur | Akses |
|-----|-------|-------|
| `/dashboard` | **Dashboard Summary** | ✅ Admin & Kasir |
| `/pos` | POS Interface | ✅ Admin & Kasir |
| `/admin/products` | 📦 **Manajemen Produk** | ✅ **Admin Only** |
| `/admin/products/create` | Tambah Produk Baru | ✅ **Admin Only** |
| `/admin/reports/daily` | 📊 Laporan Harian | ✅ **Admin Only** |
| `/admin/reports/monthly` | 📊 Laporan Bulanan + Grafik | ✅ **Admin Only** |

### **🛒 KASIR (POS Only)**

| URL | Fitur | Akses |
|-----|-------|-------|
| `/dashboard` | Dashboard Summary | ✅ Lihat |
| `/pos` | 🛒 **Transaksi Penjualan** | ✅ Main Menu |
| `/pos/search` | AJAX Search Produk | ✅ Di POS |
| `/admin/products` | ❌ Tidak bisa akses | ❌ Forbidden |
| `/admin/reports/*` | ❌ Tidak bisa akses | ❌ Forbidden |

---

## 🎮 Step-by-Step Tutorial

### **1️⃣ Login ke Sistem**

1. Buka browser: http://localhost:8000
2. Klik tombol "Login" di atas
3. Input email & password (pilih admin atau kasir)
4. Klik tombol "Log in"
5. ✅ Masuk ke dashboard

---

### **2️⃣ Dashboard (Untuk Admin & Kasir)**

**Apa yang ditampilkan:**
- 💰 **Penjualan Hari Ini** - Total & jumlah transaksi
- 📈 **Penjualan Bulan Ini** - Total & jumlah transaksi
- ⭐ **Top 5 Produk Terlaris** - Produk paling laris bulan ini
- 🔗 **Quick Links** - Tombol akses cepat

**Jika belum ada transaksi:** 
- Dashboard akan menampilkan 0
- Ada link "Mulai transaksi" untuk ke POS

---

### **3️⃣ Buka POS & Buat Transaksi (Kasir)**

**Cara akses:**
1. Dari dashboard, klik tombol "🛒 Buka POS"
2. Atau langsung ke: http://localhost:8000/pos

**Langkah-langkah transaksi:**

1. **Search Produk** (Live Search)
   - Ketik nama produk: misal "Ayam"
   - Hasil langsung muncul tanpa reload

2. **Tambah ke Keranjang**
   - Klik tombol "Tambah ke Keranjang" pada produk
   - Item langsung masuk ke keranjang (kanan)

3. **Atur Quantity**
   - Gunakan tombol +/- untuk ubah jumlah
   - Atau hapus item dengan tombol ✕

4. **Input Diskon (Opsional)**
   - Input angka di field "Diskon"
   - Total otomatis berkurang

5. **Checkout**
   - Klik tombol hijau "Checkout"
   - ✅ Transaksi berhasil
   - ✅ Stok produk berkurang otomatis
   - Redirect ke halaman struk

6. **Cetak Struk**
   - Klik tombol "🖨️ Cetak"
   - Print ke printer atau PDF
   - Klik "Kembali ke POS" untuk transaksi baru

---

### **4️⃣ Manajemen Produk (Admin Only)**

**Akses:** `/admin/products`

**Fitur:**

#### **A. Lihat Daftar Produk**
- Semua produk dengan harga & stok
- Status stok: Hijau (>10), Kuning (1-10), Merah (0)
- Pagination: 15 item per halaman

#### **B. Tambah Produk Baru**
1. Klik "+ Tambah Produk"
2. Isi form:
   - Nama Produk (misal: "Gorengan")
   - SKU (misal: "GOR-001")
   - Harga (misal: 5000)
   - Stok (misal: 100)
3. Klik "Simpan Produk"
4. ✅ Produk berhasil ditambahkan

#### **C. Edit Produk**
1. Cari produk di list
2. Klik tombol "Edit"
3. Ubah data sesuai kebutuhan
4. Klik "Simpan Perubahan"
5. ✅ Produk berhasil diupdate

#### **D. Hapus Produk**
1. Cari produk di list
2. Klik tombol "Hapus"
3. Confirm dialog muncul
4. Klik "OK"
5. ✅ Produk berhasil dihapus

---

### **5️⃣ Laporan Harian (Admin Only)**

**Akses:** `/admin/reports/daily`

**Langkah-langkah:**
1. Pilih tanggal di field date picker
2. Klik tombol "Tampilkan"
3. **Lihat:**
   - Total Transaksi (jumlah)
   - Total Penjualan (Rp)
   - Daftar detail transaksi per baris

**Informasi per transaksi:**
- No. Invoice
- Tanggal & Jam
- Nama Kasir
- Total penjualan
- Link "Lihat Detail"

---

### **6️⃣ Laporan Bulanan + Grafik (Admin Only)**

**Akses:** `/admin/reports/monthly`

**Langkah-langkah:**
1. Pilih bulan & tahun (misal: 2026-02)
2. Klik tombol "Tampilkan"
3. **Lihat:**
   - Total Transaksi
   - Total Penjualan
   - **📊 Chart.js Bar Chart** - Penjualan per hari
   - Daftar detail transaksi

**Chart.js Features:**
- Bar chart penjualan harian
- Y-axis: Format Rupiah (Rp)
- X-axis: Tanggal
- Responsive & interactive

---

## 🆘 Troubleshooting

### **Problem 1: Dashboard masih kosong**

**Solusi:**
1. Refresh halaman (F5)
2. Pastikan sudah login dengan benar
3. Cek apakah ada transaksi (lihat di `/admin/reports/daily`)
4. Jika masih kosong, itu normal = belum ada penjualan hari ini

### **Problem 2: Tombol "Buka POS" error**

**Solusi:**
1. Langsung akses: `http://localhost:8000/pos`
2. Atau dari menu, pastikan sudah login admin/kasir

### **Problem 3: Admin panel tidak bisa akses (/admin/products)**

**Solusi:**
1. Logout dan login ulang dengan: `admin@example.com`
2. Pastikan user adalah admin (role = 'admin')
3. Check: `/admin/products` hanya untuk admin

### **Problem 4: Live search tidak berfungsi**

**Solusi:**
1. Buka browser console (F12)
2. Cek apakah ada error JavaScript
3. Pastikan fetch API tersedia (Chrome, Firefox, dll)
4. Coba refresh halaman POS

### **Problem 5: Stok tidak berkurang setelah checkout**

**Solusi:**
1. Refresh halaman
2. Cek di `/admin/products` apakah stok berkurang
3. Jika masih tidak berkurang, kemungkinan ada error transaction
4. Lihat error di browser console

---

## 📊 Test Data Tersedia

**Sudah ada 8 produk test:**
1. Ayam Goreng - Rp 35.000 (stok 50)
2. Nasi Putih - Rp 8.000 (stok 100)
3. Teh Tawar - Rp 3.000 (stok 200)
4. Es Teh - Rp 5.000 (stok 150)
5. Lumpia - Rp 10.000 (stok 75)
6. Perkedel - Rp 8.000 (stok 60)
7. Bakso - Rp 15.000 (stok 40)
8. Kopi - Rp 7.000 (stok 120)

---

## ⚙️ Setup Database Ulang

Jika ingin reset database ke kondisi awal:

```bash
php artisan migrate:fresh --seed
```

Ini akan:
- ✅ Drop semua table
- ✅ Recreate semua table
- ✅ Load 2 test users
- ✅ Load 8 test products
- ✅ Hapus semua transaksi lama

---

## 🔐 Logout

**Cara logout:**
1. Klik nama user di kanan atas
2. Pilih "Sign Out" / "Logout"
3. ✅ Kembali ke halaman login

---

## 📱 Responsive Design

Sistem ini responsive di:
- 💻 Desktop (1024px+)
- 📱 Tablet (768px - 1023px)
- 📱 Mobile (< 768px)

Anda bisa akses dari HP dengan URL: `http://[IP_SERVER]:8000`

---

## 💡 Tips & Tricks

### **Tip 1: Gunakan Keyboard Shortcuts**
- Tab → Navigasi antar field
- Enter → Submit form
- F5 → Refresh halaman

### **Tip 2: Live Search Tips**
- Cukup ketik sebagian kata (misal: "Ay" untuk "Ayam")
- Cari by nama atau SKU
- Otomatis reset jika kosongkan input

### **Tip 3: Export Data**
- Laporan bisa di-screenshot atau print via browser
- Gunakan browser Print (Ctrl+P)

### **Tip 4: Performance Tips**
- Dashboard auto-update dari real data
- Live search maksimal 10 hasil per query
- Pagination 15 items untuk performa

---

**Selamat menggunakan Sistem Kasir POS! 🎉**

Untuk pertanyaan lebih lanjut, baca dokumentasi:
- `DOKUMENTASI.md` - Panduan lengkap
- `QUICK-START.md` - Setup & testing
- `API_DOCUMENTATION.md` - Endpoint details
