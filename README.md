# 🛒 Sistem Kasir (POS) Sederhana

Sistem Point of Sale (POS) yang dibangun dengan **Laravel 11** dan **Tailwind CSS**. Dilengkapi dengan semua fitur kasir modern yang mudah digunakan.

## ✨ Fitur Utama

- ✅ **Login Admin & Kasir** - Autentikasi dengan role management
- ✅ **Manajemen Produk** - CRUD produk dengan validasi SKU
- ✅ **Transaksi Penjualan** - Interface POS dengan shopping cart
- ✅ **Live Search** - AJAX real-time product search
- ✅ **Cetak Struk** - Halaman struk dengan print-friendly format
- ✅ **Laporan Harian & Bulanan** - Analytics dengan filter date
- ✅ **Grafik Penjualan** - Visualisasi dengan Chart.js
- ✅ **Auto Stock Update** - Observer pattern untuk update stok otomatis

## 🎯 Konsep Laravel yang Diimplementasikan

- 🔄 **Database Transaction** - Keamanan transaksi penjualan
- 🔍 **AJAX Live Search** - Search produk real-time tanpa reload
- 📊 **Chart.js Integration** - Visualisasi data penjualan
- 🏢 **Service Layer** - Business logic terpisah di SaleService
- 👀 **Observer Pattern** - Auto update stok saat transaksi
- 🔐 **Role-based Middleware** - Admin-only routes terlindungi
- 📝 **Form Requests** - Input validation yang proper
- 💫 **Eloquent Scopes** - Reusable query methods

## 🚀 Quick Start

### 1. Setup Database
```bash
php artisan migrate:fresh --seed
```

### 2. Run Server
```bash
php artisan serve
```

### 3. Login Test
| Role | Email | Password |
|------|-------|----------|
| Admin | admin@example.com | password |
| Kasir | kasir@example.com | password |

### 4. Akses Aplikasi
- **POS**: http://localhost:8000/pos
- **Admin Panel**: http://localhost:8000/admin/products
- **Reports**: http://localhost:8000/admin/reports/monthly

## 📂 Struktur Project

```
app/
├── Http/Controllers/
│   ├── SaleController.php        # POS & transaksi
│   ├── ProductController.php     # Manajemen produk
│   └── ReportController.php      # Laporan & grafik
├── Models/
│   ├── Product.php               # dengan scopes & relations
│   ├── Sale.php
│   ├── SaleItem.php
│   └── User.php
├── Services/
│   └── SaleService.php           # DB transaction
├── Observers/
│   └── ProductObserver.php       # Auto-update stok
└── Http/Middleware/
    └── AdminMiddleware.php       # Admin-only access
```

## 📊 Database Schema

```
users (id, name, email, password, role, ...)
products (id, name, sku, price, stock, ...)
sales (id, invoice, user_id, total, ...)
sale_items (id, sale_id, product_id, qty, price, subtotal, ...)
```

## 🔄 Workflow POS

```
1. User login (kasir)
   ↓
2. Buka POS interface (/pos)
   ↓
3. Search produk (AJAX live search)
   ↓
4. Tambah ke cart, atur quantity
   ↓
5. Klik Checkout
   ↓
6. DB::transaction() {
     - Create Sale
     - Create SaleItems
     - Decrement Product stock → Observer triggered
   }
   ↓
7. Redirect ke halaman struk & print
```

## 🎮 Testing Features

### POS Transaksi
1. Login: kasir@example.com / password
2. Buka: http://localhost:8000/pos
3. Search "Ayam"
4. Tambah ke cart (qty 2)
5. Checkout
6. ✅ Struk ditampilkan, stok berkurang otomatis

### Laporan Bulanan
1. Login: admin@example.com / password
2. Buka: http://localhost:8000/admin/reports/monthly
3. Pilih bulan
4. ✅ Chart.js bar chart menampilkan penjualan harian

### Manajemen Produk
1. Login: admin@example.com / password
2. Buka: http://localhost:8000/admin/products
3. Klik "+ Tambah Produk"
4. Fill form & submit
5. ✅ Produk berhasil ditambahkan

## 📚 Documentation

Dokumentasi lengkap tersedia dalam file:

- **[QUICK-START.md](QUICK-START.md)** - Setup & testing cepat (5 menit)
- **[DOKUMENTASI.md](DOKUMENTASI.md)** - Panduan lengkap & konsep Laravel
- **[ARCHITECTURE.md](ARCHITECTURE.md)** - System architecture & data flow diagrams
- **[API_DOCUMENTATION.md](API_DOCUMENTATION.md)** - Endpoint documentation
- **[CHECKLIST.md](CHECKLIST.md)** - Implementasi checklist
- **[RINGKASAN_IMPLEMENTASI.md](RINGKASAN_IMPLEMENTASI.md)** - Summary implementasi

## 🛠️ Technology Stack

| Layer | Technology |
|-------|-----------|
| Framework | Laravel 11 |
| Frontend | Blade Template + Tailwind CSS |
| Database | MySQL 8 |
| JavaScript | Vanilla JS + Fetch API |
| Charts | Chart.js |
| Authentication | Laravel Auth |
| Design Pattern | Service, Observer, Repository |

## 🔐 Security Features

✅ CSRF Protection - `@csrf` di semua form  
✅ Role-based Access - Admin-only routes protected  
✅ Input Validation - FormRequest validation  
✅ Database Transaction - Atomic operations  
✅ Authorization Check - User authorization rules  

## 📊 Test Data

**8 produk siap digunakan:**
- Ayam Goreng (Rp 35.000)
- Nasi Putih (Rp 8.000)
- Teh Tawar (Rp 3.000)
- Es Teh (Rp 5.000)
- Lumpia (Rp 10.000)
- Perkedel (Rp 8.000)
- Bakso (Rp 15.000)
- Kopi (Rp 7.000)

## 🚀 Production Deployment

Checklist pre-production:
- [ ] Setup environment variables (.env)
- [ ] Generate APP_KEY: `php artisan key:generate`
- [ ] Set APP_DEBUG=false
- [ ] Setup SSL/HTTPS
- [ ] Configure database backup
- [ ] Run: `php artisan optimize`
- [ ] Test di browser berbeda
- [ ] Setup email configuration

## 💡 Key Concepts Explained

### Database Transaction
```php
DB::transaction(function () {
    // Semua operasi atomic
    // Jika ada error → rollback semua
    Sale::create([...]);
    SaleItem::create([...]);
    Product::decrement('stock');
});
```

### Observer Pattern
```php
// Auto-triggered saat Product model updated
ProductObserver::updated($product) {
    if ($product->stock == 0) {
        Log::info("Stok habis: {$product->name}");
    }
}
```

### AJAX Live Search
```javascript
fetch('/pos/search?q=keyword')
    .then(res => res.json())
    .then(products => renderProducts(products));
```

## 🎓 Learning Resources

Project ini cocok untuk belajar:
- ✅ Transaction & database consistency
- ✅ Observer pattern implementation
- ✅ AJAX & asynchronous programming
- ✅ Service layer architecture
- ✅ Middleware & authorization
- ✅ Eloquent relationships
- ✅ Form validation
- ✅ Chart.js visualization

## 📞 Troubleshooting

### Database Error
```bash
php artisan migrate:fresh --seed
```

### Asset tidak tampil
```bash
npm run build
```

### Login error
```bash
php artisan key:generate
php artisan cache:clear
```

## 📝 License

Open source - bebas digunakan dan dikembangkan

## 👨‍💻 Contributing

Silakan fork, develop, dan submit pull request untuk improvement.

## ⭐ Support

Jika project ini membantu, jangan lupa untuk:
- ⭐ Star repository
- 📤 Share ke teman
- 💬 Berikan feedback

---

**Dokumentasi lengkap di folder project. Happy coding! 🎉**


Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
