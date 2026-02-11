# Dokumentasi Halaman Settings Aplikasi Kasir

## Overview
Halaman Settings adalah halaman konfigurasi aplikasi Kasir yang memungkinkan pengguna untuk mengatur pengaturan umum, informasi toko, pajak, dan tampilan aplikasi. Halaman ini diakses melalui menu navigasi dan responsif untuk semua ukuran layar.

## File-File yang Dibuat/Dimodifikasi

### 1. **View: `resources/views/settings/index.blade.php`** (BARU)
Halaman tampilan Settings dengan 4 tab utama:
- **General (Umum)**: Pengaturan bahasa, zona waktu, format tanggal/waktu, mata uang, dan debug mode
- **Store (Toko)**: Informasi toko (nama, alamat, telepon, email, website)
- **Tax (Pajak)**: Pengaturan pajak penjualan, pajak layanan, dan nomor NPWP
- **Appearance (Tampilan)**: Logo, warna tema, mode tema, dan items per halaman

**Fitur:**
- Tab navigation yang dapat diklik
- Form validation pada setiap bagian
- Icon Font Awesome untuk visual enhancement
- Responsive design (mobile-friendly)
- Styling menggunakan Tailwind CSS dan class premium-card
- Multiple submit buttons untuk setiap kategori pengaturan

### 2. **Controller: `app/Http/Controllers/SettingsController.php`** (BARU)
Controller yang mengelola logika settings aplikasi.

**Methods:**
- `index()`: Menampilkan halaman settings dengan semua pengaturan
- `update($request, $category)`: Memproses update pengaturan berdasarkan kategori (general, store, tax, appearance)
- `updateGeneralSettings()`: Validasi dan simpan pengaturan umum
- `updateStoreSettings()`: Validasi dan simpan informasi toko
- `updateTaxSettings()`: Validasi dan simpan pengaturan pajak
- `updateAppearanceSettings()`: Validasi dan simpan pengaturan tampilan (termasuk upload logo)
- `getAllSettings()`: Mengambil semua pengaturan dengan nilai default

**Storage Method:**
- Menggunakan Laravel Session untuk penyimpanan sementara (per request)
- Menggunakan Cache untuk penyimpanan persisten (hingga kembali dibuat dengan data baru)
- Dapat diperluas untuk menggunakan database dengan membuat migration dan model Settings

### 3. **Routes: `routes/web.php`** (DIMODIFIKASI)
Ditambahkan 2 route:
```php
Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
Route::put('/settings/{category}', [SettingsController::class, 'update'])->name('settings.update');
```

**Middleware:** `auth` (hanya user yang login dapat mengakses)

### 4. **Navigation: `resources/views/layouts/navigation.blade.php`** (DIMODIFIKASI)
Ditambahkan link Settings di:
- Desktop menu (dengan icon dan label)
- Mobile drawer menu (dengan icon dan label)

## Struktur Pengaturan

### General Settings (Umum)
- **Language**: Bahasa aplikasi (Indonesia/English)
- **Timezone**: Zona waktu (WIB, ICT, UTC)
- **Date Format**: Format tanggal (DD/MM/YYYY, MM/DD/YYYY, YYYY-MM-DD)
- **Time Format**: Format waktu (24 jam atau 12 jam)
- **Currency**: Simbol mata uang (Rp, $, €)
- **Debug Mode**: Toggle untuk mode debug (development only)

### Store Settings (Toko)
- **Store Name**: Nama toko
- **Store Address**: Alamat lengkap
- **Store Phone**: Nomor telepon
- **Store Email**: Email resmi
- **Store Website**: URL website

### Tax Settings (Pajak)
- **Enable Tax**: Toggle untuk mengaktifkan pajak
- **Sales Tax (PPN)**: Persentase pajak penjualan
- **Service Tax**: Persentase pajak layanan
- **NPWP Number**: Nomor Nomor Pokok Wajib Pajak

### Appearance Settings (Tampilan)
- **Logo**: Upload file logo toko
- **Primary Color**: Warna utama aplikasi (color picker)
- **Secondary Color**: Warna sekunder aplikasi (color picker)
- **Theme Mode**: Mode tema (Light, Dark, Auto)
- **Items Per Page**: Jumlah item per halaman dalam list

## Cara Menggunakan

### Mengakses Halaman Settings
1. Login ke aplikasi
2. Klik menu **Pengaturan** di navigation bar (desktop) atau dalam drawer menu (mobile)
3. Atau akses langsung melalui URL: `/settings`

### Mengubah Pengaturan
1. Klik tab yang ingin diubah
2. Isi form sesuai kebutuhan
3. Klik tombol "Simpan [Kategori]" untuk menyimpan
4. Akan muncul notifikasi sukses

### Contoh Workflow

**Mengubah Nama Toko:**
1. Buka halaman Settings
2. Klik tab "Toko"
3. Ubah field "Nama Toko"
4. Klik "Simpan Informasi Toko"

**Mengaktifkan Pajak:**
1. Buka halaman Settings
2. Klik tab "Pajak"
3. Centang "Aktifkan Pajak"
4. Isi persentase PPN dan pajak layanan
5. Klik "Simpan Pengaturan Pajak"

## Validasi & Error Handling

### Validasi Fields
**General:**
- Language: Required, harus 'id' atau 'en'
- Timezone: Required, string
- Date/Time Format: Required, string
- Currency: Required, string

**Store:**
- Store Name: Required, max 100 karakter
- Alamat/Telepon/Email/Website: Optional, dengan format tertentu

**Tax:**
- Sales/Service Tax: Numeric, 0-100
- NPWP Number: Max 50 karakter

**Appearance:**
- Logo: Image file, max 2MB (jpeg, png, gif, webp)
- Colors: Harus format HEX (#XXXXXX)
- Theme Mode: Required, light/dark/auto
- Items Per Page: Integer, 5-100

### Error Messages
Validasi form ditampilkan langsung di browser jika terjadi error. Pesan error berasal dari Laravel validation rules.

## Data Persistence

### Saat Ini (Session + Cache)
- Data disimpan di Laravel Session (hilang setelah session berakhir)
- Data juga di-cache (persisten selama server running)
- Cocok untuk testing dan development

### Untuk Production (Database - Optional)
Untuk membuat data settings persisten di database:

1. **Buat Migration:**
```bash
php artisan make:migration create_settings_table
```

2. **Migration Content:**
```php
Schema::create('settings', function (Blueprint $table) {
    $table->id();
    $table->string('key')->unique();
    $table->text('value')->nullable();
    $table->timestamps();
});
```

3. **Buat Model:**
```php
php artisan make:model Setting
```

4. **Update Controller:**
```php
// Di updateGeneralSettings()
foreach ($validated as $key => $value) {
    Setting::updateOrCreate(
        ['key' => $key],
        ['value' => $value]
    );
}
```

## Styling & Design

### Color Scheme
- Primary Color: #20a770 (Hijau)
- Secondary Color: #0D8ABC (Biru)
- Text Dark: #111827 (Abu-abu sangat gelap)
- Border Color: #E5E7EB (Abu-abu muda)

### CSS Classes Digunakan
- `.premium-card`: Container dengan border dan background putih
- `.primary-btn`: Tombol utama dengan background hijau
- Tailwind classes: `grid`, `flex`, `gap`, `px`, `py`, `text-*`, etc.

### Responsive Breakpoints
- Mobile: < 640px (Single column)
- Tablet: 640px - 1024px (2 columns untuk grid)
- Desktop: > 1024px (2-3 columns)

## Testing Checklist

- [ ] Akses halaman `/settings` dari browser
- [ ] Klik setiap tab (General, Store, Tax, Appearance)
- [ ] Isi minimal satu form di setiap tab
- [ ] Klik tombol simpan dan verifikasi notifikasi sukses
- [ ] Refresh halaman dan verifikasi data tersimpan
- [ ] Test pada mobile view (responsive)
- [ ] Test form validation (coba submit form kosong)
- [ ] Test upload logo (drag & drop atau klik)
- [ ] Test color picker untuk warna tema
- [ ] Test toggle untuk enable_tax

## Future Enhancements

1. **Database Persistence**: Simpan settings ke database bukan hanya cache
2. **Settings Categories**: Tambah kategori baru seperti Email, SMS, API Keys
3. **Backup Settings**: Backup dan restore pengaturan
4. **Audit Log**: Track siapa yang mengubah setting dan kapan
5. **Permission System**: Kontrol siapa saja yang bisa mengubah settings
6. **Settings History**: Simpan history perubahan settings
7. **Export/Import**: Export dan import pengaturan dari file
8. **Template Settings**: Preset pengaturan untuk berbagai jenis bisnis

## Troubleshooting

**Masalah:** Pengaturan tidak tersimpan setelah refresh
**Solusi:** Implementasi database persistence menggunakan Setting model

**Masalah:** Logo upload tidak bekerja
**Solusi:** Pastikan storage symlink sudah dibuat: `php artisan storage:link`

**Masalah:** Color picker tidak muncul
**Solusi:** Pastikan browser support HTML5 input type="color"

## File Summary

| File | Tipe | Status | Deskripsi |
|------|------|--------|-----------|
| resources/views/settings/index.blade.php | View | BARU | Halaman utama settings |
| app/Http/Controllers/SettingsController.php | Controller | BARU | Logika business settings |
| routes/web.php | Routes | MODIFIED | Tambah 2 route settings |
| resources/views/layouts/navigation.blade.php | Layout | MODIFIED | Tambah link settings menu |

## Summary Implementasi

✅ **Completed:**
1. Halaman Settings dengan 4 tab utama
2. Controller dengan validasi lengkap
3. Routes untuk GET dan PUT
4. Navigation menu dengan link settings
5. Responsive design (mobile + desktop)
6. Form validation
7. Icon dan styling lengkap

📝 **Dapat Dikembangkan:**
1. Database persistence
2. Settings categories tambahan
3. Audit logging
4. Permission system
5. Settings history
6. Backup/restore functionality
