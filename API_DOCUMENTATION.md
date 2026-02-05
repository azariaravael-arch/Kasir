# 🔌 API & Endpoint Documentation

## 📍 Public Routes

### `GET /`
**Welcome Page**
- Status: Public
- Auth: None
- Response: HTML page

---

## 🔐 Authenticated Routes

### `GET /dashboard`
**User Dashboard**
- Status: Authenticated users only
- Auth: Required + verified email
- Response: Dashboard view

---

## 🛒 POS Routes (Kasir & Admin)

### `GET /pos`
**POS Interface - Browse & Checkout**
- Status: Authenticated
- Auth: Required (kasir or admin)
- Response: HTML - POS interface dengan products list

**Example:**
```
GET http://localhost:8000/pos
Authorization: Bearer {session}
Response: HTML page dengan form transaksi
```

---

### `GET /pos/search`
**Live Search Produk (AJAX)**
- Status: Authenticated
- Auth: Required (kasir or admin)
- Method: GET
- Query Parameters:
  - `q` (string, required) - Search keyword

**Request:**
```
GET /pos/search?q=Ayam
Headers:
  - Accept: application/json
  - X-Requested-With: XMLHttpRequest
```

**Response (JSON):**
```json
[
  {
    "id": 1,
    "name": "Ayam Goreng",
    "sku": "AYG-001",
    "price": 35000,
    "stock": 50
  },
  {
    "id": 7,
    "name": "Bakso",
    "sku": "BKS-001",
    "price": 15000,
    "stock": 40
  }
]
```

**Frontend Usage:**
```javascript
fetch('/pos/search?q=Ayam')
  .then(res => res.json())
  .then(products => {
    // Render products...
  });
```

---

### `POST /pos`
**Create Sale Transaction**
- Status: Authenticated
- Auth: Required (kasir or admin)
- Method: POST
- Content-Type: application/json

**Request Body:**
```json
{
  "items": [
    {
      "product_id": 1,
      "qty": 2,
      "price": 35000
    },
    {
      "product_id": 2,
      "qty": 1,
      "price": 8000
    }
  ]
}
```

**Response (Success 200):**
```json
{
  "success": true,
  "message": "Transaksi berhasil disimpan",
  "sale_id": 15,
  "invoice": "INV-20260205-AB3CD"
}
```

**Response (Validation Error 422):**
```json
{
  "success": false,
  "message": "Stok produk tidak cukup"
}
```

**Frontend Usage:**
```javascript
const token = document.querySelector('meta[name="csrf-token"]').content;

fetch('/pos', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': token
  },
  body: JSON.stringify({
    items: [
      { product_id: 1, qty: 2, price: 35000 }
    ]
  })
})
.then(res => res.json())
.then(data => {
  if (data.success) {
    window.location.href = `/pos/${data.sale_id}/receipt`;
  }
});
```

---

### `GET /pos/{id}`
**View Sale Details**
- Status: Authenticated
- Auth: Required (creator or admin)
- Method: GET
- Parameters:
  - `id` (integer) - Sale ID

**Response:**
```html
<page>
  Invoice: INV-20260205-AB3CD
  User: Kasir
  Items:
    - Ayam Goreng (2) × Rp 35.000
    - Nasi Putih (1) × Rp 8.000
  Total: Rp 78.000
  [Lihat Struk] button
</page>
```

---

### `GET /pos/{id}/receipt`
**Print Sale Receipt**
- Status: Authenticated
- Auth: Required (creator or admin)
- Method: GET
- Parameters:
  - `id` (integer) - Sale ID

**Response:**
```html
<page style="print-format">
  STRUK PENJUALAN
  
  No. Invoice: INV-20260205-AB3CD
  Tanggal: 05/02/2026 14:30
  Kasir: Kasir
  
  Produk              Qty  Harga   Subtotal
  Ayam Goreng         2    35.000  70.000
  Nasi Putih          1    8.000   8.000
  
  TOTAL: Rp 78.000
  
  Terima kasih telah berbelanja
  [Cetak] [Kembali]
</page>
```

**CSS Print:**
```css
@media print {
  body { background: white; }
  button { display: none; }
}
```

---

## 📦 Product Management (Admin Only)

### `GET /admin/products`
**List Products**
- Status: Admin only
- Auth: Required + isAdmin()
- Method: GET
- Query Parameters:
  - `page` (integer, optional) - Pagination page

**Response:**
```html
<page>
  Produk                SKU       Harga    Stok  Aksi
  Ayam Goreng          AYG-001   35000    50    [Edit] [Hapus]
  Nasi Putih           NSP-001   8000     100   [Edit] [Hapus]
  ...
  [Pagination controls]
  [+ Tambah Produk button]
</page>
```

---

### `GET /admin/products/create`
**Create Product Form**
- Status: Admin only
- Auth: Required + isAdmin()
- Response: HTML form dengan fields:
  - name (text, required, unique)
  - sku (text, required, unique)
  - price (number, required, min:0)
  - stock (number, required, min:0)

---

### `POST /admin/products`
**Store New Product**
- Status: Admin only
- Auth: Required + isAdmin()
- Method: POST

**Request:**
```
POST /admin/products
Content-Type: application/x-www-form-urlencoded

name=Gorengan&sku=GOR-001&price=5000&stock=100
```

**Response (Redirect):**
```
Redirect: /admin/products
Flash: success = "Produk berhasil ditambahkan"
```

**Validation Errors:**
```json
{
  "name": ["The name field is required"],
  "sku": ["The sku has already been taken"],
  "price": ["The price must be at least 0"],
  "stock": ["The stock must be at least 0"]
}
```

---

### `GET /admin/products/{id}/edit`
**Edit Product Form**
- Status: Admin only
- Auth: Required + isAdmin()
- Method: GET
- Parameters:
  - `id` (integer) - Product ID

**Response:** HTML form pre-filled dengan data produk

---

### `PUT /admin/products/{id}`
**Update Product**
- Status: Admin only
- Auth: Required + isAdmin()
- Method: PUT (or POST with _method=PUT)

**Request:**
```
PUT /admin/products/1
Content-Type: application/json

{
  "name": "Ayam Goreng Keju",
  "sku": "AYG-001",
  "price": 45000,
  "stock": 75
}
```

**Response (Redirect):**
```
Redirect: /admin/products
Flash: success = "Produk berhasil diperbarui"
```

---

### `DELETE /admin/products/{id}`
**Delete Product**
- Status: Admin only
- Auth: Required + isAdmin()
- Method: DELETE (or POST with _method=DELETE)

**Response (Redirect):**
```
Redirect: /admin/products
Flash: success = "Produk berhasil dihapus"
```

---

## 📊 Reports & Analytics (Admin Only)

### `GET /admin/reports/daily`
**Daily Sales Report**
- Status: Admin only
- Auth: Required + isAdmin()
- Method: GET
- Query Parameters:
  - `date` (date, optional) - Filter by date (YYYY-MM-DD)

**Response:**
```html
<page>
  Filter: [date input] [Show button]
  
  Total Transaksi: 5
  Total Penjualan: Rp 500.000
  
  Daftar Transaksi:
  Invoice              Waktu     Kasir  Total
  INV-20260205-AB3CD   14:30:00  Kasir  78000
  INV-20260205-XY4ZM   15:45:00  Kasir  125000
  ...
</page>
```

---

### `GET /admin/reports/monthly`
**Monthly Sales Report with Chart**
- Status: Admin only
- Auth: Required + isAdmin()
- Method: GET
- Query Parameters:
  - `month` (month, optional) - Filter by month (YYYY-MM)

**Response:**
```html
<page>
  Filter: [month input] [Show button]
  
  Total Transaksi: 47
  Total Penjualan: Rp 8.500.000
  
  [Chart.js Bar Chart - Penjualan Harian]
  
  Daftar Transaksi:
  Invoice              Tanggal       Kasir  Total
  INV-20260205-AB3CD   05/02/2026    Kasir  78000
  ...
</page>
```

---

### `GET /admin/reports/chart-data`
**Chart Data (AJAX)**
- Status: Admin only
- Auth: Required + isAdmin()
- Method: GET
- Query Parameters:
  - `period` (string) - 'daily', 'weekly', 'monthly'
  - `date` (date) - Reference date

**Response (JSON):**
```json
{
  "labels": ["05 Feb", "06 Feb", "07 Feb"],
  "data": [500000, 750000, 600000],
  "count": [3, 5, 4]
}
```

**Frontend Usage:**
```javascript
fetch('/admin/reports/chart-data?period=monthly&date=2026-02-01')
  .then(res => res.json())
  .then(data => {
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: data.labels,
        datasets: [{
          label: 'Penjualan',
          data: data.data
        }]
      }
    });
  });
```

---

## 🔐 Authentication Routes

### `GET /login`
**Login Form**
- Status: Public (guest only)
- Response: HTML login form

---

### `POST /login`
**Process Login**
- Status: Public
- Method: POST
- Request:
  ```
  email=user@example.com
  password=password
  ```
- Response: Redirect to dashboard

---

### `POST /logout`
**Process Logout**
- Status: Authenticated
- Method: POST
- Response: Redirect to home

---

## 📋 Routes Summary Table

| Method | Endpoint | Auth | Role | Purpose |
|--------|----------|------|------|---------|
| GET | / | - | - | Welcome page |
| GET | /login | guest | - | Login form |
| POST | /login | guest | - | Process login |
| POST | /logout | auth | all | Process logout |
| GET | /dashboard | auth | all | User dashboard |
| GET | /pos | auth | kasir, admin | POS interface |
| GET | /pos/search | auth | kasir, admin | AJAX search |
| POST | /pos | auth | kasir, admin | Create sale |
| GET | /pos/{id} | auth | creator, admin | View sale |
| GET | /pos/{id}/receipt | auth | creator, admin | Print receipt |
| GET | /admin/products | auth | admin | List products |
| GET | /admin/products/create | auth | admin | Create form |
| POST | /admin/products | auth | admin | Store product |
| GET | /admin/products/{id}/edit | auth | admin | Edit form |
| PUT | /admin/products/{id} | auth | admin | Update product |
| DELETE | /admin/products/{id} | auth | admin | Delete product |
| GET | /admin/reports/daily | auth | admin | Daily report |
| GET | /admin/reports/monthly | auth | admin | Monthly report |
| GET | /admin/reports/chart-data | auth | admin | Chart AJAX |

---

## 💡 Common Usage Examples

### **Contoh: Checkout dari Frontend**

```javascript
// 1. Prepare items
const items = [
  { product_id: 1, qty: 2, price: 35000 },
  { product_id: 2, qty: 1, price: 8000 }
];

// 2. Get CSRF token
const token = document.querySelector('meta[name="csrf-token"]').content;

// 3. Send POST request
fetch('/pos', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': token
  },
  body: JSON.stringify({ items })
})
.then(r => r.json())
.then(data => {
  if (data.success) {
    alert(`Invoice: ${data.invoice}`);
    // Redirect ke struk
    location.href = `/pos/${data.sale_id}/receipt`;
  } else {
    alert(`Error: ${data.message}`);
  }
})
.catch(err => console.error(err));
```

---

### **Contoh: Search Produk dari Frontend**

```javascript
document.getElementById('search').addEventListener('keyup', function(e) {
  const query = e.target.value;
  
  if (query.length < 1) {
    location.reload();
    return;
  }

  fetch(`/pos/search?q=${query}`)
    .then(r => r.json())
    .then(products => {
      // Render products...
      products.forEach(product => {
        console.log(`${product.name} - Rp ${product.price}`);
      });
    });
});
```

---

### **Contoh: Load Chart dari Backend**

```javascript
// Di view blade template
const chartData = {!! json_encode($chartData) !!};

new Chart(document.getElementById('chart'), {
  type: 'bar',
  data: {
    labels: chartData.map(item => item.date),
    datasets: [{
      label: 'Penjualan Harian',
      data: chartData.map(item => item.total),
      backgroundColor: 'rgba(59, 130, 246, 0.5)',
      borderColor: 'rgba(59, 130, 246, 1)',
      borderWidth: 2
    }]
  }
});
```

---

## ✅ Status Code Reference

| Code | Meaning | Example |
|------|---------|---------|
| 200 | OK | Transaksi berhasil |
| 201 | Created | Produk berhasil dibuat |
| 204 | No Content | Delete berhasil |
| 400 | Bad Request | Invalid input |
| 401 | Unauthorized | Login required |
| 403 | Forbidden | Admin required |
| 404 | Not Found | Resource tidak ada |
| 422 | Validation Error | Field validation error |
| 500 | Server Error | Database error |

---

**Dokumentasi API Lengkap** ✅

Untuk testing API, bisa gunakan tools seperti:
- Postman
- Insomnia
- cURL
- Browser DevTools
