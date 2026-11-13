const assert = require('node:assert/strict');
const { test } = require('node:test');
const { luhnCheck, generateVisaNumber } = require('../src/creditCard');

test('generates a 16-digit Visa card number that passes Luhn', () => {
  const card = generateVisaNumber();
  assert.match(card, /^4\d{15}$/);
  assert.equal(luhnCheck(card), true);
});
