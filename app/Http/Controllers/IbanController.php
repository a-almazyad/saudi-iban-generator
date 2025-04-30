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
    private function generateIban()
    {
        $bankMap = [
            80 => 'Al Rajhi Bank',
            30 => 'SNB (Saudi National Bank)',
            60 => 'Riyad Bank',
            50 => 'Banque Saudi Fransi',
            20 => 'Alinma Bank',
            10 => 'SABB',
            40 => 'Arab National Bank',
            70 => 'Bank AlJazira',
            90 => 'GIB',
            33 => 'Alawwal Bank',
            31 => 'Bank Albilad',
            // Add more banks as needed
        ];
    
        $bankCode = array_rand($bankMap);
        $bankName = $bankMap[$bankCode];
    
        $accountNumber = '';
        for ($i = 0; $i < 18; $i++) {
            $accountNumber .= rand(0, 9);
        }
    
        $bban = $bankCode . $accountNumber;
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
    public function apiGenerate()
{
    $result = $this->generateIban(); // reuse existing logic
    return response()->json($result);
}
}
