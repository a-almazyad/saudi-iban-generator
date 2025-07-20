function calculateCheckDigits(countryCode, bban) {
  const rearranged = bban + countryCode + '00';
  let converted = '';
  for (const ch of rearranged) {
    converted += isNaN(ch) ? (ch.toUpperCase().charCodeAt(0) - 55).toString() : ch;
  }
  const mod97 = BigInt(converted) % 97n;
  return String(98n - mod97).padStart(2, '0');
}

function generateIban(bankCode) {
  const paddedBankCode = bankCode.toString().padStart(2, '0');
  const accountNumber = Array.from({ length: 18 }, () => Math.floor(Math.random() * 10)).join('');
  const bban = paddedBankCode + accountNumber;
  const checkDigits = calculateCheckDigits('SA', bban);
  return 'SA' + checkDigits + bban;
}

module.exports = {
  calculateCheckDigits,
  generateIban
};
