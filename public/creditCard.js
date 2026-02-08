(function(global){
function luhnCheck(number) {
  const digits = number.split('').map(d => parseInt(d, 10));
  let sum = 0;
  for (let i = digits.length - 1; i >= 0; i--) {
    let digit = digits[i];
    if ((digits.length - i) % 2 === 0) {
      digit *= 2;
      if (digit > 9) digit -= 9;
    }
    sum += digit;
  }
  return sum % 10 === 0;
}

function generateVisaNumber() {
  let digits = [4];
  for (let i = 1; i < 15; i++) {
    digits[i] = Math.floor(Math.random() * 10);
  }
  let sum = 0;
  for (let i = digits.length - 1; i >= 0; i--) {
    let digit = digits[i];
    if ((digits.length - i) % 2 === 1) { // because check digit not yet appended
      digit *= 2;
      if (digit > 9) digit -= 9;
    }
    sum += digit;
  }
  const checkDigit = (10 - (sum % 10)) % 10;
  digits.push(checkDigit);
  return digits.join('');
}

function generateCard(storage) {
  const number = generateVisaNumber();

  const now = new Date();
  const startMonth = now.getFullYear() * 12 + now.getMonth();
  const endMonth = startMonth + 60;
  const randMonth = Math.floor(Math.random() * (endMonth - startMonth + 1)) + startMonth;
  const year = Math.floor(randMonth / 12);
  const month = randMonth % 12;
  const expiry = String(month + 1).padStart(2, '0') + '/' + String(year % 100).padStart(2, '0');

  const cvv = Math.floor(100 + Math.random() * 900);
  const card = { number, expiry, cvv };

  if (storage && typeof storage.getItem === 'function' && typeof storage.setItem === 'function') {
    const history = JSON.parse(storage.getItem('cardHistory') || '[]');
    history.unshift({ number, expiry, cvv });
    storage.setItem('cardHistory', JSON.stringify(history.slice(0, 10)));
  }

  return card;
}


  global.CreditCard = { luhnCheck, generateVisaNumber };
})(typeof window !== 'undefined' ? window : globalThis);
