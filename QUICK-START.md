# 🚀 Quick Start - Sistem Kasir POS

## ⚡ Setup Cepat (5 Menit)

### 1️⃣ Setup Database
```bash
php artisan migrate:fresh --seed
```
✅ Database ready dengan 2 test users & 8 produk

### 2️⃣ Run Server
```bash
php artisan serve
```
Server berjalan di: **http://localhost:8000**

### 3️⃣ Login Test

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@example.com | password |
| Kasir | kasir@example.com | password |

---

## 📍 URL Penting

### 👥 Kasir (User Biasa)
- `http://localhost:8000/pos` → Interface POS dengan cart
- `http://localhost:8000/pos/{id}/receipt` → Cetak struk

### 👨‍💼 Admin Only
- `http://localhost:8000/admin/products` → Manajemen produk
- `http://localhost:8000/admin/products/create` → Tambah produk
- `http://localhost:8000/admin/reports/daily` → Laporan harian
- `http://localhost:8000/admin/reports/monthly` → Laporan bulanan + grafik

---

## 🎮 Testing Senario

### **Scenario 1: Membuat Transaksi Penjualan**

1. Login sebagai: `kasir@example.com`
2. Buka: `/pos`
3. **Search produk**: ketik "Ayam" di search bar
4. **Tambah ke cart**: klik tombol "Tambah ke Keranjang"
5. **Atur quantity**: gunakan tombol +/- untuk ubah jumlah
6. **Opsional diskon**: input diskon di form
7. **Checkout**: klik tombol hijau "Checkout"
8. **Hasil**: 
   - ✅ Invoice number: INV-20260205-XXXXX
   - ✅ Redirect ke halaman struk
   - ✅ Stok produk berkurang otomatis

### **Scenario 2: Laporan Harian**

1. Login sebagai: `admin@example.com`
2. Buka: `/admin/reports/daily`
3. Pilih tanggal yang ada transaksi
4. **Lihat**:
   - Total transaksi count
   - Total penjualan (Rp)
   - Daftar detail transaksi

### **Scenario 3: Laporan Bulanan dengan Grafik**

1. Login sebagai: `admin@example.com`
2. Buka: `/admin/reports/monthly`
3. Pilih bulan & tahun
4. **Lihat**:
   - Bar chart penjualan harian
   - Total transaksi & penjualan
   - Daftar detail per transaksi

### **Scenario 4: Manajemen Produk**

1. Login sebagai: `admin@example.com`
2. Buka: `/admin/products`
3. **Tambah**: Klik "+ Tambah Produk"
   - Isi: nama, SKU, harga, stok
   - Submit → Success message
4. **Edit**: Klik "Edit" di row produk
   - Ubah data → Submit → Updated
5. **Hapus**: Klik "Hapus" → Confirm → Success

---

## 🎯 Fitur Explained

### **Live Search (POS)**
- Real-time search tanpa reload halaman
- Search by: nama produk atau SKU
- Backend: `/pos/search?q=keyword` (AJAX)
- Frontend: Fetch API + vanilla JS

### **Shopping Cart**
- Tambah/edit/hapus item
- Qty counter dengan validasi stok
- Auto-calculate subtotal & total
- Diskon support

### **Database Transaction**
```php
// Semua proses dalam 1 transaction:
1. Create Sale record
2. Create SaleItem records  
3. Decrement Product stock
// Jika ada error → semua rollback
```

### **Auto Stock Update (Observer)**
- Saat `Product::decrement()` dipanggil
- ProductObserver otomatis triggered
- Log: Jika stok == 0
- Pattern: Observer + Event System

### **Chart.js Grafik**
- Bar chart penjualan harian
- Y-axis: Rp (currency format)
- X-axis: Tanggal
- Responsive canvas element

---

## 🛠️ Troubleshooting

### Database Error?
```bash
# Reset database
php artisan migrate:fresh --seed

# Clear cache
php artisan cache:clear
php artisan config:clear
```

### Asset tidak tampil (CSS/JS)?
```bash
# Build assets
npm run build

# atau development mode
npm run dev
```

### 404 Not Found?
- Pastikan route terdaftar di `routes/web.php`
- Check middleware: `auth`, `admin`, `verified`
- Cek role user: `dd(auth()->user())`

### Login tidak bisa?
```bash
# Regenerate app key
php artisan key:generate

# Fresh migration with seed
php artisan migrate:fresh --seed
```

---

## 📊 Database Structure

```
users
├── id
├── name
├── email
├── password
├── role (admin/kasir)
└── timestamps

products  
├── id
├── name
├── sku (unique)
├── price
├── stock
└── timestamps

sales
├── id
├── invoice (INV-YYYYMMDD-XXXXX)
├── user_id (FK users)
├── total
└── timestamps

sale_items
├── id
├── sale_id (FK sales)
├── product_id (FK products)
├── qty
├── price
├── subtotal
└── timestamps
```

---

## 🎓 Tech Stack

| Layer | Technology |
|-------|-----------|
| Framework | Laravel 11 |
| Database | MySQL 8 |
| Frontend | Blade + Tailwind CSS |
| JavaScript | Vanilla JS + Fetch API |
| Charts | Chart.js |
| Auth | Laravel Auth |
| Patterns | Service, Observer, Middleware |

---

## 📚 File Dokumentasi

- `DOKUMENTASI.md` → Panduan lengkap & konsep Laravel
- `CHECKLIST.md` → Checklist implementasi
- `QUICK-START.md` → File ini

---

## 💡 Tips Development

### Debugging
```php
// Di controller:
dd($variable);        // Die & dump
dump($variable);       // Dump tapi continue
\Log::info('message'); // Log ke storage/logs
```

### Database Debugging
```php
// Enable query log
DB::enableQueryLog();
$data = Product::all();
dd(DB::getQueryLog());
```

### Test User Creation
```bash
php artisan tinker
User::factory()->create([
    'name' => 'Test Admin',
    'email' => 'test@example.com',
    'role' => 'admin'
]);
```

---

## 🚀 Siap Deploy?

Checklist pre-production:
- [ ] Ganti APP_KEY
- [ ] Set APP_DEBUG=false
- [ ] Setup SSL/HTTPS
- [ ] Optimize cache: `php artisan optimize`
- [ ] Setup backup database
- [ ] Configure email sender
- [ ] Test di browser berbeda
- [ ] Load testing penjualan

---

**Enjoy your POS System! 🎉**

Untuk dokumentasi lengkap, baca: `DOKUMENTASI.md`
