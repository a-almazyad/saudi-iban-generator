const { calculateCheckDigits, generateIban } = require('../src/iban');

describe('calculateCheckDigits', () => {
  test('returns correct digits for known BBAN examples', () => {
    const bban1 = '80000000608010167519';
    const bban2 = '20000001234567891234';
    expect(calculateCheckDigits('SA', bban1)).toBe('03');
    expect(calculateCheckDigits('SA', bban2)).toBe('44');
  });
});

describe('generateIban', () => {
  test('produces a valid Saudi IBAN string', () => {
    const iban = generateIban('80');
    expect(iban).toMatch(/^SA\d{22}$/);
    expect(iban.slice(4,6)).toBe('80'); // bank code
  });
});
