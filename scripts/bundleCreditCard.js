const fs = require('fs');
const path = require('path');

const srcPath = path.join(__dirname, '..', 'src', 'creditCard.js');
const destPath = path.join(__dirname, '..', 'public', 'creditCard.js');

let content = fs.readFileSync(srcPath, 'utf8');
// Remove CommonJS export line
content = content.replace(/module\.exports\s*=\s*\{[\s\S]*?\};?\n?/m, '');

const bundle = `(function(global){\n${content}\n  global.CreditCard = { generateVisaNumber };\n})(typeof window !== 'undefined' ? window : globalThis);\n`;

fs.writeFileSync(destPath, bundle);
console.log('Bundled credit card helper to', destPath);
