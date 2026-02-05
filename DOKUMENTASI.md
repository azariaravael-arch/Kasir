# 🛒 Sistem Kasir (POS) Sederhana - Panduan Lengkap

Project ini adalah sistem kasir (Point of Sale/POS) sederhana yang dibangun dengan Laravel 11 dan Tailwind CSS.

## 📋 Fitur Utama

✅ **Login Admin & Kasir** - Manajemen role-based access  
✅ **Manajemen Produk & Stok** - Create, Read, Update, Delete produk dengan stok otomatis  
✅ **Transaksi Penjualan** - Proses penjualan dengan database transaction  
✅ **Cetak Struk (PDF)** - Cetak atau download struk penjualan  
✅ **Laporan Harian & Bulanan** - Laporan transaksi berdasarkan periode  
✅ **Grafik Penjualan** - Visualisasi penjualan menggunakan Chart.js  

## 🎯 Konsep Laravel yang Diimplementasikan

- **Database Transaction** - Keamanan transaksi penjualan
- **Live Search (AJAX)** - Search produk real-time tanpa reload halaman
- **Chart.js** - Visualisasi data grafik penjualan
- **Service Layer** - Business logic di SaleService
- **Observer Pattern** - Auto update stok saat ada transaksi
- **Middleware** - Role-based access control (Admin & Kasir)
- **Form Requests** - Validasi request yang proper
- **Eloquent Relations** - Model relationships yang clean

---

## 🚀 Cara Menggunakan

### 1. **Setup Project**

```bash
# Install dependencies
composer install
npm install

# Generate APP_KEY
php artisan key:generate

# Setup database (sesuaikan di .env)
php artisan migrate:fresh --seed

# Build assets
npm run build
# atau untuk development
npm run dev
```

### 2. **Login Test**

Ada 2 user yang sudah dibuat:

**Admin:**
- Email: `admin@example.com`
- Password: `password`
- Akses: Manajemen produk, laporan, grafik

**Kasir:**
- Email: `kasir@example.com`
- Password: `password`
- Akses: Hanya POS/transaksi

---

## 📁 Struktur File

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── SaleController.php      # POS interface & transaksi
│   │   ├── ProductController.php   # Manajemen produk
│   │   └── ReportController.php    # Laporan & grafik
│   ├── Middleware/
│   │   ├── AdminMiddleware.php     # Admin-only access
│   │   └── RoleMiddleware.php      # Role-based access
│   └── Requests/
│       └── StoreSaleRequest.php    # Validasi transaksi
├── Models/
│   ├── Product.php         # Model produk dengan scope
│   ├── Sale.php            # Model transaksi penjualan
│   ├── SaleItem.php        # Model item dalam transaksi
│   └── User.php            # Model user dengan role
├── Services/
│   └── SaleService.php     # Business logic penjualan
└── Observers/
    └── ProductObserver.php # Observer untuk update stok

routes/
└── web.php                 # Semua routes aplikasi

resources/views/
├── pos/
│   ├── index.blade.php     # Interface POS dengan live search
│   ├── receipt.blade.php   # Struk penjualan
│   └── show.blade.php      # Detail transaksi
├── products/
│   ├── index.blade.php     # List produk
│   ├── create.blade.php    # Form tambah produk
│   └── edit.blade.php      # Form edit produk
└── reports/
    ├── daily.blade.php     # Laporan harian
    └── monthly.blade.php   # Laporan bulanan + grafik
```

---

## 🎮 Fitur Dijelaskan

### **1. POS Interface** (`/pos`)

- **Live Search Produk** - Cari produk berdasarkan nama atau SKU
- **Shopping Cart** - Tambah/kurangi/hapus item dengan qty counter
- **Diskon** - Bisa memberikan diskon untuk transaksi
- **Checkout** - Proses transaksi dengan validasi stok

**Cara Kerja:**
1. User mengetik di search bar → AJAX query ke backend
2. Hasil ditampilkan secara real-time
3. Klik "Tambah ke Keranjang" → item masuk ke cart
4. Atur quantity dengan +/- button
5. Klik "Checkout" → transaksi disimpan ke database
6. Stok otomatis dikurangi via Observer
7. Redirect ke halaman struk

### **2. Manajemen Produk** (`/admin/products`)

**Admin Only:**
- ✅ Tambah produk baru
- ✅ Edit produk (nama, SKU, harga, stok)
- ✅ Hapus produk
- ✅ Lihat daftar semua produk dengan pagination

Validasi:
- Nama & SKU harus unik
- Harga & stok minimal 0

### **3. Cetak Struk** 

- Tombol "Lihat Struk" di halaman detail transaksi
- Tombol "Cetak" untuk print ke printer
- Format struk yang rapi dan mudah dibaca
- CSS special untuk print

### **4. Laporan & Grafik**

**Laporan Harian** (`/admin/reports/daily`):
- Filter berdasarkan tanggal
- Tampil ringkasan: total transaksi & total penjualan
- Daftar detail transaksi dengan link ke detail

**Laporan Bulanan** (`/admin/reports/monthly`):
- Filter berdasarkan bulan & tahun
- Ringkasan transaksi & penjualan
- **Grafik batang** penjualan harian menggunakan Chart.js
- Daftar detail transaksi

---

## 🛠️ Routes Lengkap

```
PUBLIC:
GET  /                           → Welcome page
GET  /dashboard                  → User dashboard

KASIR & ADMIN:
GET  /pos                        → Interface POS
GET  /pos/search                 → AJAX search produk
POST /pos                        → Store transaksi
GET  /pos/{sale}                 → Detail transaksi
GET  /pos/{sale}/receipt         → Struk penjualan

ADMIN ONLY:
GET    /admin/products                → List produk
GET    /admin/products/create         → Form tambah produk
POST   /admin/products                → Store produk baru
GET    /admin/products/{product}/edit → Form edit produk
PUT    /admin/products/{product}      → Update produk
DELETE /admin/products/{product}      → Delete produk
GET    /admin/reports/daily           → Laporan harian
GET    /admin/reports/monthly         → Laporan bulanan
GET    /admin/reports/chart-data      → AJAX data untuk chart
```

---

## 📊 Database Schema

### **Users**
```sql
id, name, email, password, role (admin/kasir), email_verified_at, created_at, updated_at
```

### **Products**
```sql
id, name, sku, price, stock, created_at, updated_at
```

### **Sales**
```sql
id, invoice, user_id (FK), total, created_at, updated_at
```

### **Sale Items**
```sql
id, sale_id (FK), product_id (FK), qty, price, subtotal, created_at, updated_at
```

---

## 🔐 Keamanan

✅ **CSRF Protection** - Semua form pakai `@csrf`  
✅ **Role-based Middleware** - Admin-only routes terlindungi  
✅ **Request Validation** - FormRequest untuk input validation  
✅ **Database Transaction** - Transaksi penjualan atomic  
✅ **Authorization** - User hanya bisa lihat transaksi mereka sendiri  

---

## 🐛 Testing

### Scenario 1: Membuat Transaksi
1. Login sebagai kasir
2. Buka /pos
3. Search produk (misal: "Ayam")
4. Tambah ke keranjang, atur quantity
5. Input diskon (opsional)
6. Klik Checkout
7. ✓ Transaksi berhasil, arahkan ke struk

### Scenario 2: Laporan Bulanan dengan Grafik
1. Login sebagai admin
2. Buka /admin/reports/monthly
3. Pilih bulan & tahun
4. ✓ Tampil ringkasan + grafik penjualan harian
5. Klik "Lihat Detail" untuk melihat transaksi

### Scenario 3: Manajemen Produk
1. Login sebagai admin
2. Buka /admin/products
3. Klik "Tambah Produk"
4. Isi form dan submit
5. ✓ Produk berhasil ditambahkan
6. Edit/Hapus produk sesuai kebutuhan

---

## 📦 Package yang Digunakan

- **Laravel 11** - Framework
- **Tailwind CSS** - Styling
- **Chart.js** - Grafik
- **MySQL** - Database
- **Vite** - Asset bundler

---

## 🎓 Pelajaran Konsep Laravel

### **1. Database Transaction**
```php
// app/Services/SaleService.php
DB::transaction(function () {
    // Semua operasi dalam blok ini atomic
    // Jika ada error, semua di-rollback
    $sale = Sale::create([...]);
    foreach ($items as $item) {
        // ... proses item
    }
});
```

### **2. Observer Pattern**
```php
// app/Observers/ProductObserver.php
Product::observe(ProductObserver::class); // di AppServiceProvider

// Automatically triggered when Product model updated
public function updated(Product $product) {
    if ($product->stock <= 0) {
        \Log::info("Produk {$product->name} stoknya habis");
    }
}
```

### **3. Scope untuk Query**
```php
// app/Models/Product.php
public function scopeActive($query) {
    return $query->where('stock', '>', 0);
}

// Usage:
Product::active()->get(); // Hanya produk dengan stok > 0
```

### **4. Live Search dengan AJAX**
```javascript
// resources/views/pos/index.blade.php
fetch(`/pos/search?q=${query}`)
    .then(response => response.json())
    .then(data => {
        // Update UI dengan hasil search
    });
```

### **5. Middleware Role-based**
```php
// routes/web.php
Route::middleware(['auth', 'admin'])->group(function(){
    // Hanya admin yang bisa akses
});
```

---

## 🚀 Pengembangan Lebih Lanjut

Ide fitur tambahan:

1. **Payment Gateway Integration** - Integrasi Midtrans/GoPay
2. **Inventory Adjustment** - Adjust stok manual untuk stockopname
3. **Customer Management** - Tambah member/loyalty points
4. **Multi-branch** - Support untuk multiple toko
5. **Barcode Scanner** - Scan barcode produk
6. **Email Receipt** - Kirim struk via email
7. **Export Report** - Export laporan ke Excel/PDF
8. **User Activity Log** - Audit trail untuk setiap transaksi
9. **Return Produk** - Proses pengembalian barang
10. **Budget Analytics** - Analisis trend penjualan & forecast

---

## 📞 Support & Tips

### Common Issues:

**Database Error?**
```bash
php artisan migrate:fresh --seed
```

**Asset tidak tampil?**
```bash
npm run build
```

**Permission Error?**
```bash
sudo chown -R $USER:$USER storage/
chmod -R 775 storage/
```

---

## 👨‍💻 Tech Stack Summary

| Aspek | Teknologi |
|-------|-----------|
| Backend | Laravel 11 |
| Frontend | Blade Template + Tailwind CSS |
| Database | MySQL 8 |
| Async | AJAX (Fetch API) |
| Grafik | Chart.js |
| Authentication | Laravel Auth |
| Validation | Form Requests |
| Design Pattern | Service Layer, Observer, Repository |

---

**Happy Coding! 🎉**
