# Mobile Testing Guide

## Bagaimana Menguji Responsive Design

---

## 🖥️ Method 1: Browser DevTools (Recommended)

### Chrome / Edge
```
1. Buka aplikasi Kasir di browser
2. Tekan F12 atau Ctrl+Shift+I (Windows) / Cmd+Option+I (Mac)
3. Tekan Ctrl+Shift+M untuk Toggle Device Toolbar
4. Pilih device atau ukuran custom
```

### Firefox
```
1. Buka aplikasi Kasir
2. Tekan F12 atau Ctrl+Shift+I
3. Klik "Responsive Design Mode" atau tekan Ctrl+Shift+M
4. Pilih device atau adjust size
```

### Safari
```
1. Buka aplikasi Kasir
2. Tekan Cmd+Option+I
3. Klik "Responsive Design Mode" (jika tersedia)
4. Test dengan berbagai ukuran
```

---

## 📱 Method 2: Real Device Testing

### Setup
```bash
# Pastikan komputer dan mobile di network yang sama

# Di komputer, dapatkan IP address:
Windows: ipconfig | find "IPv4"
Mac/Linux: ifconfig | grep "inet "

# Contoh IP: 192.168.1.100
# Di mobile browser, buka: http://192.168.1.100:8000
```

### Pages to Test
```
Dashboard:      http://192.168.1.100:8000/dashboard
Products:       http://192.168.1.100:8000/products
Kasir:          http://192.168.1.100:8000/pos
Purchases:      http://192.168.1.100:8000/purchases
Returns:        http://192.168.1.100:8000/returns
```

---

## 📋 Testing Checklist

### Mobile (< 640px)

#### Navigation
- [ ] Hamburger menu visible
- [ ] Click hamburger → menu opens
- [ ] Menu items all accessible
- [ ] User dropdown works
- [ ] Logout button works
- [ ] Menu closes when clicking outside

#### Products Page
- [ ] Products display as cards (not table)
- [ ] Card layout looks good
- [ ] Product images visible (70px size)
- [ ] Prices readable
- [ ] Edit button works
- [ ] Delete button works
- [ ] Search functionality works
- [ ] No horizontal scroll

#### Dashboard
- [ ] Summary cards full-width
- [ ] Stats visible
- [ ] Quick action buttons clickable
- [ ] No text overflow
- [ ] All readable

#### Kasir (POS)
- [ ] Product grid visible
- [ ] Products are clickable
- [ ] Checkout cart visible below
- [ ] Can add items to cart
- [ ] Quantity controls work
- [ ] Buttons not cut off
- [ ] All text readable
- [ ] No horizontal scroll

### Tablet (640px - 1024px)

#### Navigation
- [ ] Menu starts showing items
- [ ] Hamburger still visible (< 768px)
- [ ] Navigation looks balanced

#### Layout
- [ ] Grid layouts adapt smoothly
- [ ] Content properly spaced
- [ ] No awkward whitespace

#### Interactions
- [ ] All buttons work
- [ ] Forms are usable
- [ ] Dropdowns function

### Desktop (> 1024px)

#### Full Experience
- [ ] All features enabled
- [ ] Desktop layouts active
- [ ] Hover effects work
- [ ] Side-by-side layouts visible (POS)
- [ ] Table displays properly (Products)

---

## 🔍 Specific Features to Test

### 1. Navigation Menu
```
Mobile:
┌─ Hamburger Icon
│  ├─ Dashboard
│  ├─ Master Data
│  ├─ Kasir
│  ├─ Pembelian
│  ├─ Retur
│  ├─ Supplier
│  ├─ Produk
│  └─ Laporan
└─ User Profile

Desktop:
┌─ Logo ├─ Menu Items (horizontal) ├─ User Profile
```

### 2. Products Table → Card
```
Desktop:
┌──────────────────────────────────┐
│ Image │ Name │ Category │ Price  │
│       │      │          │ Stok   │
│                          │ Actions│
└──────────────────────────────────┘

Mobile:
┌─────────────────────────┐
│ ┌─────┐                 │
│ │     │ Name            │
│ │ Img │ SKU: xxx        │
│ │     │ Category        │
│ └─────┘                 │
│ Price: Rp XXX           │
│ Stok: XX Unit           │
│ [Edit] [Delete]         │
└─────────────────────────┘
```

### 3. Kasir Layout
```
Mobile:
┌─────────────────────┐
│   Search Products   │
├─────────────────────┤
│   Product Grid      │
│   (multiple rows)   │
├─────────────────────┤
│   Checkout Cart     │
│   (fixed height)    │
└─────────────────────┘

Desktop:
┌──────────────────────────────┐
│ Search │          │ Checkout │
│Product │          │   Cart   │
│ Grid   │  (flex)  │ Summary  │
│        │          │ Buttons  │
└──────────────────────────────┘
```

---

## ⚡ Performance Testing

### Lighthouse (Chrome DevTools)
```
1. F12 → Lighthouse tab
2. Select "Mobile" device
3. Run audit
4. Check:
   - Performance: > 80
   - Accessibility: > 90
   - Best Practices: > 90
```

### Network Throttling
```
1. Open DevTools
2. Network tab
3. Select "Slow 3G" or "Fast 3G"
4. Reload page
5. Test functionality at slow speed
```

---

## 🎯 Touch Testing

### Points to Test
- [ ] All buttons are touchable (min 44×44px)
- [ ] Spacing between elements (min 8px)
- [ ] No hover-only interactions
- [ ] Forms work with virtual keyboard
- [ ] Scrolling is smooth
- [ ] No accidental clicks

### Test Scenario
```
1. Open POS page on mobile
2. Tap product card
3. Item adds to cart
4. Adjust quantity using +/- buttons
5. Remove item using X button
6. Complete transaction
```

---

## 🔄 Responsive Testing Workflow

### Quick Test (5 minutes)
```
1. Open browser DevTools (F12)
2. Toggle device toolbar (Ctrl+Shift+M)
3. Test iPhone SE (375px)
4. Test iPad (768px)
5. Verify no horizontal scroll
6. Check all buttons clickable
```

### Medium Test (15 minutes)
```
1. Test all pages:
   - Dashboard
   - Products
   - Kasir
   - Purchases
   - Returns
2. Test on multiple devices:
   - Mobile (375px)
   - Tablet (768px)
   - Desktop (1280px)
3. Test interactions
4. Verify responsiveness
```

### Full Test (30 minutes)
```
1. Complete medium test
2. Test network throttling
3. Test on real devices
4. Test all forms
5. Test all buttons
6. Check accessibility
7. Run Lighthouse audit
8. Document any issues
```

---

## 📊 Test Results Template

```
Date: _______________
Tester: ______________
Device: _____________

PAGE: _____________
├─ Layout: ✓ / ✗
├─ Navigation: ✓ / ✗
├─ Text Readable: ✓ / ✗
├─ Images Visible: ✓ / ✗
├─ Buttons Work: ✓ / ✗
├─ Forms Work: ✓ / ✗
├─ No H-Scroll: ✓ / ✗
└─ Notes: _________________

Issues Found:
1. _____________________
2. _____________________
3. _____________________

OVERALL: PASS / FAIL
```

---

## 🆘 Common Issues & Solutions

### Issue: Text Too Small
**Solution**: Increase font size
```css
/* Instead of: */
class="text-sm"

/* Use: */
class="text-xs sm:text-sm md:text-base"
```

### Issue: Horizontal Scroll
**Solution**: Check container width
```html
<!-- Make sure container is full-width -->
<div class="w-full px-3 sm:px-4">
```

### Issue: Buttons Not Touchable
**Solution**: Increase size to 44×44px minimum
```css
/* Minimum button size */
padding: 0.75rem;
min-height: 44px;
min-width: 44px;
```

### Issue: Layout Breaking
**Solution**: Use Tailwind breakpoints properly
```html
<!-- Mobile first approach -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
```

---

## 💡 Tips for Testing

1. **Test Different Orientations**
   - Portrait (normal)
   - Landscape (rotated)

2. **Test Different Networks**
   - Slow 3G
   - Fast 3G
   - 4G

3. **Test Touch Interactions**
   - Long press
   - Double tap
   - Swipe (if applicable)

4. **Test with Different Browsers**
   - Chrome/Edge
   - Firefox
   - Safari

5. **Test Real Devices**
   - iPhone
   - Android
   - Tablet

---

## ✅ Checklist Before Going Live

```
MOBILE TESTING:
├─ Navigation responsive ✓
├─ All pages tested ✓
├─ Touch-friendly ✓
├─ No H-scroll ✓
├─ Forms work ✓
├─ Performance good ✓
├─ Real device tested ✓
└─ Accessibility checked ✓

BREAKPOINT TESTING:
├─ Mobile (375px) ✓
├─ Mobile (768px) ✓
├─ Tablet (1024px) ✓
├─ Desktop (1280px) ✓
└─ Large (1920px) ✓

FEATURE TESTING:
├─ Login works ✓
├─ Dashboard loads ✓
├─ Kasir functional ✓
├─ Products CRUD works ✓
├─ Purchases CRUD works ✓
├─ Returns works ✓
└─ Logout works ✓

PERFORMANCE:
├─ LCP < 2.5s ✓
├─ FID < 100ms ✓
├─ CLS < 0.1 ✓
└─ Lighthouse > 80 ✓
```

---

## 📸 Screenshots to Take

For documentation, capture:
1. Mobile navigation (open & closed)
2. Products page (mobile & desktop)
3. Kasir page (mobile & desktop)
4. Dashboard (mobile)
5. Forms on mobile
6. Lighthouse audit results

---

## 🎓 Learning Resources

- [Chrome DevTools - Device Mode](https://developer.chrome.com/docs/devtools/device-mode/)
- [MDN - Responsive Design](https://developer.mozilla.org/en-US/docs/Learn/CSS/CSS_layout/Responsive_Design)
- [Web.dev - Mobile](https://web.dev/mobile/)
- [Tailwind - Responsive Design](https://tailwindcss.com/docs/responsive-design)

---

## ✨ Summary

Responsive testing memastikan aplikasi bekerja sempurna di semua device. Gunakan checklist ini untuk comprehensive testing!

**Happy Testing!** 🚀

---

**Last Updated:** February 11, 2026
**Maintained By:** Development Team
**Status:** Active
