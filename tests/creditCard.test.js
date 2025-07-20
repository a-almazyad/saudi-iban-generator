const { luhnCheck, generateVisaNumber } = require('../src/creditCard');

describe('generateVisaNumber', () => {
  test('generates a 16-digit Visa card number that passes Luhn', () => {
    const card = generateVisaNumber();
    expect(card).toMatch(/^4\d{15}$/);
    expect(luhnCheck(card)).toBe(true);
  });
});
