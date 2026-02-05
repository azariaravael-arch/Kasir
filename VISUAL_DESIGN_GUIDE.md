# 🎨 Visual Design Guide - POS System

Panduan lengkap untuk memahami dan menggunakan design system yang telah diimplementasikan.

---

## 🌟 Design Philosophy

### Core Principles
1. **Clarity** - Jelas, readable, mudah dipahami
2. **Consistency** - Same styling untuk komponenyang sama
3. **Professionalism** - Modern, trustworthy, business-ready
4. **Usability** - Intuitif, efficient, minimal learning curve

### Visual Style
- **Modern Minimalist** dengan accent yang cukup
- **Rounded Corners** untuk softer appearance
- **Generous Spacing** untuk breathing room
- **Strategic Color** untuk visual hierarchy
- **Smooth Animations** untuk user delight

---

## 🎯 Color System

### Primary Palette

#### Emerald (Primary)
```
Emerald-50     #F0FDF4  (Very light)
Emerald-100    #DCFCE7
Emerald-200    #BBFBEE
Emerald-300    #6EE7B7  (Light)
Emerald-400    #34D399
Emerald-500    #10B981  (Main)
Emerald-600    #059669  🎯 PRIMARY
Emerald-700    #047857
Emerald-800    #065F46
Emerald-900    #064E3B  (Very dark)
```
**Usage**: Primary buttons, success states, highlights

#### Slate (Neutral)
```
Slate-50       #F8FAFC  (Background)
Slate-100      #F1F5F9
Slate-200      #E2E8F0  (Borders)
Slate-400      #94A3B8
Slate-500      #64748B
Slate-600      #475569  (Secondary buttons)
Slate-700      #334155
Slate-800      #1E293B
Slate-900      #0F172A  (Dark text)
```
**Usage**: Text, backgrounds, borders, neutral actions

#### Rose (Error/Danger)
```
Rose-50        #FFF5F7
Rose-100       #FFE4E6
Rose-200       #FECDD3
Rose-600       #E11D48  (Delete buttons)
Rose-700       #BE123C
```
**Usage**: Delete actions, error messages, warnings

#### Indigo & Amber (Accent)
```
Indigo-600     #4F46E5  (Secondary highlight)
Amber-500      #F59E0B  (Attention)
```
**Usage**: Variation, secondary actions, alerts

---

## 📐 Spacing System

### Padding & Margin
```
Space-0    = 0px
Space-1    = 0.25rem (4px)    - Minimal
Space-2    = 0.5rem (8px)     - Small
Space-3    = 0.75rem (12px)   - Tight
Space-4    = 1rem (16px)      - Comfortable
Space-6    = 1.5rem (24px)    - Relaxed
Space-8    = 2rem (32px)      - Spacious
Space-10   = 2.5rem (40px)    - Very spacious
Space-12   = 3rem (48px)      - Large
```

### Form Elements
```
Input padding:     px-6 py-3    (32px, 12px)
Button padding:    py-4         (16px height)
Card padding:      p-8 to p-10  (32-40px all sides)
Form spacing:      space-y-8    (32px between fields)
```

### Grid & Layout
```
Card gaps:         gap-8        (32px)
Table rows:        py-4 to py-6 (16-24px)
Column spacing:    lg:gap-8     (32px)
Grid cols:         md:grid-cols-2 lg:grid-cols-3/4
```

---

## 🔤 Typography System

### Font Stack
```
Font Family: "Outfit", system fonts
```

### Size & Weight
```
Heading 1 (h1)     text-4xl    font-black   tracking-tight
Heading 2 (h2)     text-3xl    font-black   tracking-tight
Heading 3 (h3)     text-2xl    font-black   tracking-tight
Label              text-sm     font-black   tracking-widest uppercase
Body               text-base   font-medium  (default)
Small              text-xs     font-bold    
Badge/Tag          text-[10px] font-black   uppercase
```

### Font Weights
```
font-medium        500  - Body text, descriptions
font-semibold      600  - Section headers
font-black         900  - Main titles, labels, emphasis
```

### Letter Spacing
```
tracking-tighter    -0.05em
tracking-tight      -0.025em    - Used for titles
tracking-normal     0
tracking-widest     0.1em       - Used for labels
```

---

## 🌈 Component Styling Guide

### Buttons

#### Primary Button (Emerald)
```php
<button class="
    bg-emerald-600 
    hover:bg-emerald-700 
    active:scale-95
    text-white 
    py-3 px-6 
    rounded-2xl 
    font-black 
    tracking-widest 
    uppercase
    transition 
    shadow-lg 
    shadow-emerald-200
">
    ✅ Simpan
</button>
```
**Size Variations**:
- Small: `py-2 px-4 text-sm`
- Medium: `py-3 px-6 text-base` (default)
- Large: `py-4 px-8 text-lg`

#### Secondary Button (Slate)
```php
<button class="
    bg-slate-600 
    dark:bg-gray-700
    hover:bg-slate-700 
    text-white 
    py-3 px-6 
    rounded-2xl 
    font-black
    shadow-lg
">
    ❌ Batal
</button>
```

#### Danger Button (Rose)
```php
<button class="
    bg-rose-600 
    hover:bg-rose-700
    text-white 
    px-3 py-1
    rounded-xl 
    font-black 
    text-xs
">
    🗑️ Hapus
</button>
```

### Form Inputs

#### Standard Input
```php
<input 
    type="text" 
    class="
        w-full
        px-6 py-3
        border-2 border-slate-200
        dark:border-gray-700
        dark:bg-gray-800
        dark:text-gray-100
        rounded-2xl
        focus:outline-none
        focus:ring-2 
        focus:ring-emerald-500
        focus:border-emerald-500
        transition
    "
/>
```

#### Select Dropdown
```php
<select class="
    w-full
    px-6 py-3
    border-2 border-slate-200
    dark:border-gray-700
    dark:bg-gray-800
    dark:text-gray-100
    rounded-2xl
    focus:outline-none
    focus:ring-2 
    focus:ring-emerald-500
">
```

#### File Upload Area
```php
<div class="
    border-2 border-dashed 
    border-slate-300
    dark:border-gray-700
    rounded-2xl 
    p-8
    transition
    hover:border-emerald-500 
    hover:bg-emerald-50/30
    dark:hover:bg-emerald-900/10
">
    <input type="file" class="hidden" />
    📷 Drag & drop di sini
</div>
```

### Cards & Containers

#### Standard Card
```php
<div class="
    bg-white 
    dark:bg-gray-900
    rounded-[2.5rem]
    p-8
    shadow-xl 
    shadow-slate-200/50
    dark:shadow-none
    border-2 border-slate-100
    dark:border-gray-800
">
```

#### Gradient Card (Summary)
```php
<div class="
    bg-gradient-to-br 
    from-emerald-600 
    to-teal-700
    rounded-[2.5rem]
    p-8
    shadow-2xl 
    shadow-emerald-200
    dark:shadow-none
    hover:scale-[1.02]
    transition
    text-white
">
```

#### Alert Box (Success)
```php
<div class="
    bg-emerald-50 
    dark:bg-emerald-900/20
    border border-emerald-200 
    dark:border-emerald-800
    text-emerald-700 
    dark:text-emerald-300
    px-6 py-4 
    rounded-2xl
    font-bold
    flex items-center gap-3
">
    ✅ Success message
</div>
```

#### Alert Box (Error)
```php
<div class="
    bg-rose-50 
    dark:bg-rose-900/20
    border border-rose-200 
    dark:border-rose-800
    text-rose-700 
    dark:text-rose-300
    px-6 py-4 
    rounded-2xl
    font-bold
">
    ⚠️ Error message
</div>
```

### Badges & Tags

#### Status Badge
```php
<span class="
    inline-flex 
    items-center 
    gap-1
    bg-emerald-50 
    dark:bg-emerald-900/20
    text-emerald-600 
    dark:text-emerald-400
    px-3 py-1 
    rounded-full
    text-xs 
    font-black
    tracking-widest 
    uppercase
    border 
    border-emerald-100 
    dark:border-emerald-800
">
    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
    Active
</span>
```

#### Category Badge
```php
<span class="
    px-4 py-1 
    bg-slate-100 
    dark:bg-gray-800
    text-slate-600 
    dark:text-slate-400
    rounded-full 
    text-[10px] 
    font-black 
    tracking-widest 
    uppercase
">
    Food
</span>
```

### Tables

#### Table Header
```php
<thead>
    <tr class="
        bg-slate-50 
        dark:bg-gray-800/50
        text-slate-400 
        text-[10px] 
        font-black 
        uppercase 
        tracking-[0.2em]
        border-b 
        border-slate-100 
        dark:border-gray-800
    ">
```

#### Table Row (Hover)
```php
<tr class="
    group
    hover:bg-slate-50/50 
    dark:hover:bg-gray-800/30
    transition-all 
    duration-300
">
```

---

## 🎭 Hover & Interaction States

### Button Hover States
```css
/* Emerald Primary */
bg-emerald-600 
  hover:bg-emerald-700 
  active:scale-95 
  transition

/* Slate Secondary */
bg-slate-600 
  hover:bg-slate-700 
  active:scale-95 
  transition

/* Scale on Hover (Icons) */
text-3xl 
  transition-transform 
  group-hover:scale-125

/* Color Change on Hover */
text-slate-400 
  group-hover:text-emerald-500 
  transition-colors
```

### Card Hover Effects
```css
/* Scale & Shadow */
hover:scale-[1.02] 
hover:shadow-2xl 
transition-all 
duration-500

/* Border Change */
border-2 border-transparent 
hover:border-emerald-500 
transition

/* Image Zoom */
group-hover:scale-110 
transition-transform 
duration-700
```

### Text Hover
```css
/* Color Change */
text-slate-900 
group-hover:text-emerald-600 
transition-colors

/* Underline */
hover:underline 
decoration-2 
underline-offset-4
```

---

## 🌙 Dark Mode Implementation

### Pattern
```php
<!-- Struktur umum -->
<div class="
    bg-white dark:bg-gray-900
    text-slate-900 dark:text-white
    border-slate-200 dark:border-gray-800
    shadow-sm dark:shadow-none
">
```

### Colors Mapping
```
Light Mode         Dark Mode
─────────────────  ─────────────────
white              dark:bg-gray-900
slate-50           dark:bg-gray-800
slate-100          dark:bg-gray-700
slate-900          dark:text-white
slate-200          dark:border-gray-800
```

### Best Practices
1. Selalu pair light & dark variant
2. Kurangi shadows di dark mode
3. Maintain contrast ratios
4. Test readability di kedua mode

---

## 📱 Responsive Design Examples

### Grid Responsive
```php
<!-- 1 column mobile, 2 md, 3 lg, 4 xl -->
<div class="grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
```

### Sidebar Layout
```php
<!-- Mobile: stacked, Desktop: sidebar layout -->
<div class="flex flex-col md:flex-row gap-8">
    <aside class="md:w-64">Sidebar</aside>
    <main class="flex-1">Content</main>
</div>
```

### Navigation
```php
<!-- Mobile: collapse, Desktop: horizontal -->
<nav class="flex flex-col md:flex-row gap-4">
```

---

## ⚡ Performance & Best Practices

### CSS Output
- Inline Tailwind = minimal CSS file size
- Purge unused styles via build process
- Group similar utilities together

### Animation Performance
```css
/* GPU-accelerated */
transform, scale, rotate    ✅
opacity                      ✅

/* CPU-heavy (avoid) */
width, height                ❌
padding, margin              ❌
```

### Optimization Tips
1. Use `transition-all` sparingly
2. Limit animation duration (300-500ms)
3. Use `:not(:hover)` untuk non-hover states
4. Prefer `opacity` untuk fading

---

## 📋 Component Checklist

Saat membuat komponen baru, pastikan:
- [ ] Color scheme konsisten (emerald/slate)
- [ ] Spacing konsisten (gap-8, p-8)
- [ ] Typography hierarchy jelas
- [ ] Dark mode support added
- [ ] Hover effects implemented
- [ ] Responsive layout tested
- [ ] Accessibility considered
- [ ] Error states included

---

## 🎓 Quick Reference

| Kebutuhan | Class |
|-----------|-------|
| Primary Button | `bg-emerald-600 hover:bg-emerald-700 py-3 px-6 rounded-2xl font-black` |
| Secondary Button | `bg-slate-600 hover:bg-slate-700 py-3 px-6 rounded-2xl font-black` |
| Danger Button | `bg-rose-600 hover:bg-rose-700 py-2 px-4 rounded-xl font-black text-xs` |
| Form Input | `border-2 border-slate-200 rounded-2xl px-6 py-3 focus:ring-2 focus:ring-emerald-500` |
| Card | `bg-white dark:bg-gray-900 rounded-[2.5rem] p-8 shadow-xl` |
| Success Alert | `bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 rounded-2xl px-6 py-4` |
| Error Alert | `bg-rose-50 dark:bg-rose-900/20 border border-rose-200 rounded-2xl px-6 py-4` |
| Badge | `bg-slate-100 dark:bg-gray-800 text-slate-600 px-3 py-1 rounded-full text-xs font-black` |

---

**Last Updated**: 5 Februari 2026  
**Design System Version**: 1.0  
**Status**: Complete & Production-Ready

Gunakan panduan ini sebagai referensi saat membuat atau memodifikasi komponen! 🎨
