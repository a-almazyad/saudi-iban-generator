# 🇸🇦 Saudi IBAN Generator

![Version](https://img.shields.io/badge/version-1.0.0-blue)
![License](https://img.shields.io/github/license/a-almazyad/saudi-iban-generator)

🔗 [Live Demo](https://saudi-iban-generator.onrender.com/)

## 🖼️ Preview

![screenshot](public/IBAN.png)

## ✨ Features

- 🔢 Generate valid **Saudi IBANs**
- 🏦 Choose or randomize banks (with logos)
- 🧠 Auto-detect and display **bank name**
- 📋 One-click **copy to clipboard** with feedback
- 🕓 Store and display **recent IBANs** (localStorage)
- 🌙 Fully supports **dark/light mode** with OS theme detection
- 🌐 Supports **English & Arabic** with RTL switching
- 🎨 Animated UI using **Tailwind CSS** + **Alpine.js**

---

## 🧰 Tech Stack

- **Frontend**: HTML, Tailwind CSS (CDN), Alpine.js (CDN)
- **No Backend Required**: Pure static app

---

## 🚀 Deployment Options

This is a static app. You can deploy it with:

- GitHub Pages
- Netlify
- Render
- Vercel

### Deployment Settings

#### 🔹 Render
- Type: Static Site
- Build command: *(leave blank)*
- Publish directory: `public`

#### 🔹 GitHub Pages
- Use `public` folder as the source
- Recommended: `gh-pages` branch or GitHub Actions

#### 🔹 Netlify
- Build command: *(leave blank)*
- Publish directory: `public`

#### 🔹 Vercel
- Output directory: `public`
- Preset: Other

---

## ▶️ Running Locally

```bash
cd public
python3 -m http.server 8080
# Then open http://localhost:8080 in your browser
```

Or just open `public/index.html` directly.

---

## 📁 Project Structure

```
saudi-iban-generator/
├── public/
│   ├── index.html
│   ├── logos/
│   ├── IBAN.png
│   └── version.txt
├── README.md
```

---

## 👤 Author

Made with 💚 by [Abdullah Almazyad](https://github.com/a-almazyad)
