const { luhnCheck, generateVisaNumber, generateCard } = require('../src/creditCard');

describe('generateVisaNumber', () => {
  test('generates a 16-digit Visa card number that passes Luhn', () => {
    const card = generateVisaNumber();
    expect(card).toMatch(/^4\d{15}$/);
    expect(luhnCheck(card)).toBe(true);
  });
});

describe('generateCard', () => {
  test('returns card object with valid Luhn number and formatted expiry', () => {
    const card = generateCard();
    expect(card.number).toMatch(/^4\d{15}$/);
    expect(luhnCheck(card.number)).toBe(true);
    expect(card.expiry).toMatch(/^\d{2}\/\d{2}$/);
    expect(String(card.cvv)).toMatch(/^\d{3}$/);
  });

  test('stores generated cards in localStorage history', () => {
    const mockStorage = (() => {
      let store = {};
      return {
        getItem: key => store[key] || null,
        setItem: (key, val) => { store[key] = val; },
      };
    })();

    for (let i = 0; i < 12; i++) {
      generateCard(mockStorage);
    }

    const history = JSON.parse(mockStorage.getItem('cardHistory'));
    expect(history).toHaveLength(10);
    expect(history[0]).toHaveProperty('number');
    expect(history[0]).toHaveProperty('expiry');
    expect(luhnCheck(history[0].number)).toBe(true);
  });
});
