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


  global.CreditCard = { generateVisaNumber };
})(typeof window !== 'undefined' ? window : globalThis);
