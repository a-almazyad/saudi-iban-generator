# 🇸🇦 Saudi IBAN Generator

A simple and elegant Laravel application that generates valid Saudi IBANs with identified banks. Built with modern front-end technologies including Tailwind CSS and Alpine.js, this project provides a responsive UI and real-time client-side interactivity.

## ✨ Features

- 🔁 Generate valid **Saudi IBANs** in one click
- 🏦 Detect and display the **corresponding bank**
- 📋 One-click **copy to clipboard**
- 🕓 Saves and shows **recent IBAN history**
- 🌙 Clean, responsive UI styled with **Tailwind CSS**
- ⚡ Interactive UI powered by **Alpine.js**

---

## ⚙️ Tech Stack

- **Backend**: Laravel 12 (PHP 8.3+)
- **Frontend**: Tailwind CSS + Alpine.js
- **Build Tools**: Vite
- **Database**: SQLite (used for session & minimal storage)
- **Deployment**: Compatible with platforms like **Render**

---

## 🧪 Local Development

### 1. Clone the repository
```bash
git clone https://github.com/a-almazyad/saudi-iban-generator.git
cd saudi-iban-generator
```

### 2. Install dependencies
```bash
composer install
npm install
```

### 3. Setup environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Run locally
```bash
php artisan serve
npm run dev
```

> Open [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser.

---

## 🚀 Deployment

To deploy the project (e.g., on Render or a similar platform):

1. **Build production assets:**
   ```bash
   npm run build
   ```

2. **Cache configurations:**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

3. **Ensure `.env` is set correctly for production:**
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com
   ```

4. **Commit built assets if needed for deployment:**
   ```bash
   git add public/build
   git commit -m "Add production build"
   git push
   ```

---

## 📝 License

This project is open-sourced under the MIT License.

---

## 👤 Author

Developed by [Abdullah Almazyad](https://github.com/a-almazyad)
