# 🇸🇦 Saudi IBAN Generator

A fast and lightweight static web app to generate valid Saudi IBANs with the correct bank identifier. Designed for simplicity and performance with no backend dependencies.

## ✨ Features

- 🔁 Generate valid **Saudi IBANs** instantly
- 🏦 Choose a specific bank or let the app select one randomly
- 🏦 Detect and display the **corresponding bank name**
- 📋 One-click **copy to clipboard**
- 🕓 Store and display **recent IBAN history** in the browser
- 🎨 Styled using **Tailwind CSS** via CDN
- ⚡ Reactive interactivity with **Alpine.js**

---

## 🧰 Tech Stack

- **Frontend**: HTML, Tailwind CSS (CDN), Alpine.js (CDN)
- **No Backend Required**: Runs entirely in the browser

---

## 🚀 Deployment

This is a pure static site. You can deploy it using:

- GitHub Pages
- Netlify
- Render (as a Static Site)
- Vercel


### ⚙️ Deployment Instructions

#### Render
- **Service type**: Static Site
- **Build command**: *(leave blank)*
- **Publish directory**: `public`

#### GitHub Pages
- Use the `public` folder as the source.
- Recommended: use a branch like `gh-pages` or deploy via GitHub Actions.

#### Netlify
- **Build command**: *(leave blank)*
- **Publish directory**: `public`
- Drag and drop the `public` folder in the Netlify UI or connect a Git repo.

#### Vercel
- Import the project and set the `public` directory as the output directory.
- **Framework preset**: Other

---

## ▶️ Running Locally

Simply open the `public/index.html` file in your browser. No build or dev server needed.

---

## 📁 Project Structure

```
saudi-iban-generator/
├── public/
│   └── index.html
├── README.md
```

---

## 👤 Author

Developed by [Abdullah Almazyad](https://github.com/a-almazyad)
