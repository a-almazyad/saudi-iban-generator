<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IbanController extends Controller
{
    public function index()
    {
        return view('iban');
    }

    public function generate(Request $request)
    {
        $result = $this->generateIban();
        return view('iban', ['iban' => $result['iban'], 'bank' => $result['bank']]);
    }

    private function generateIban($forcedBankCode = null)
    {
        $bankMap = [
            05 => 'Alinma Bank',
            10 => 'SNB (Saudi National Bank)',
            15 => 'Bank Albilad',
            20 => 'Riyad Bank',
            30 => 'Arab National Bank',
            36 => 'D360 Bank',
            45 => 'SABB',
            55 => 'Banque Saudi Fransi',
            60 => 'Bank AlJazira',
            65 => 'Saudi Investment Bank',
            78 => 'STC Bank',
            80 => 'Al Rajhi Bank',
            90 => 'GIB'
        ];

        $bankCode = $forcedBankCode !== null ? (int) $forcedBankCode : array_rand($bankMap);
        $bankName = $bankMap[$bankCode] ?? 'Unknown';
        $bankCodePadded = str_pad($bankCode, 2, '0', STR_PAD_LEFT);

        $accountNumber = '';
        for ($i = 0; $i < 18; $i++) {
            $accountNumber .= rand(0, 9);
        }

        $bban = $bankCodePadded . $accountNumber;
        $checkDigits = $this->calculateCheckDigits('SA', $bban);
        $iban = 'SA' . $checkDigits . $bban;

        return [
            'iban' => $iban,
            'bank' => $bankName
        ];
    }

    private function calculateCheckDigits($countryCode, $bban)
    {
        $rearranged = $bban . $countryCode . '00';
        $converted = '';
        foreach (str_split($rearranged) as $ch) {
            $converted .= ctype_alpha($ch) ? (ord(strtoupper($ch)) - 55) : $ch;
        }
        $remainder = bcmod($converted, '97');
        return str_pad(98 - $remainder, 2, '0', STR_PAD_LEFT);
    }

    public function apiGenerate(Request $request)
    {
        $bankCode = $request->query('bank');
        $result = $this->generateIban($bankCode);
        return response()->json($result);
    }
}