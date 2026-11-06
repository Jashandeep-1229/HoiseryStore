# 🧦 HoiseryStore

**Free, open-source inventory & billing software for hosiery and garment shops.**

Built with Laravel 9, it manages your whole shop from one dashboard: stock, barcodes, purchases, sales, accounts and WhatsApp marketing.

## ✨ Features

- 📦 **Catalog**: categories, brands, seasons, items with sizes and variants
- 🏷️ **Barcodes**: auto-generate and print barcode labels
- 🏬 **Inventory**: stock in/out, average cost, item statements
- 🛒 **Purchases & Sales**: vendor purchase orders, customer sales, POS billing
- 💰 **Accounts**: ledgers, income and expenses, payment methods (Cash/UPI/Bank)
- 📊 **Reports**: profit, stock, sales, purchases, transactions
- 📲 **WhatsApp Marketing**: send campaigns through the WhatsApp Cloud API
- 🔐 **Secure login**: email OTP, staff and sub-user accounts

## 🛠️ Tech Stack

Laravel 9 · PHP 8 · MySQL · Blade · jQuery DataTables · DomPDF

## 🚀 Installation

```bash
git clone https://github.com/Jashandeep-1229/HoiseryStore.git
cd HoiseryStore
composer install
cp .env.example .env
php artisan key:generate
```

Then set your database details in `.env` and run:

```bash
php artisan migrate
php artisan serve
```

Open http://127.0.0.1:8000 in your browser.

### WhatsApp setup (optional)
Add your Meta WhatsApp Cloud API details to `.env`:
