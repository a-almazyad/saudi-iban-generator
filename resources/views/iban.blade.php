<!DOCTYPE html>
<html lang="en" x-data="ibanApp()" x-init="loadHistory()">
<head>
    <meta charset="UTF-8">
    <title>Saudi IBAN Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 text-gray-800 flex items-center justify-center min-h-screen px-4 transition">

    <!-- Toast Notification -->
    <div 
        x-show="showToast" 
        x-transition 
        class="fixed top-6 left-1/2 transform -translate-x-1/2 bg-white text-black px-4 py-2 rounded shadow-lg ring-1 ring-gray-300 z-50 text-sm"
        x-text="toastMessage"
        x-cloak
    ></div>

    <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-2xl w-full max-w-md text-center transition">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-xl font-bold flex items-center justify-center gap-2">
                🇸🇦 Saudi IBAN Generator
            </h1>
        </div>

        <!-- IBAN Display -->
        <div class="mb-4" x-show="generatedIban">
            <p class="text-sm sm:text-base mb-1">
                <span class="font-semibold">Generated IBAN:</span>
                <span id="iban-text" class="text-blue-700 font-mono break-words" x-text="generatedIban.iban"></span>
            </p>
            <p class="text-sm text-gray-600">
                <span class="font-semibold">Bank:</span>
                <span x-text="generatedIban.bank"></span>
            </p>
            <button @click="copyIban()" class="mt-3 bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition text-sm">
                📋 Copy IBAN
            </button>
        </div>

        <!-- Generate Button -->
        <div class="mt-4">
            <button @click="generateIban()" type="button" class="w-full text-sm sm:text-base bg-green-600 text-white px-4 py-3 sm:px-6 rounded-full hover:bg-green-700 transition font-semibold">
                🔁 Generate IBAN
            </button>
        </div>

        <!-- IBAN History -->
        <template x-if="ibanHistory.length">
            <div class="mt-6 text-left">
                <h2 class="text-sm font-semibold text-gray-700 mb-2 flex justify-between items-center">
                    <span>Recent IBANs:</span>
                    <button @click="clearHistory()" class="text-xs text-red-600 hover:underline">
                        🗑️ Clear History
                    </button>
                </h2>
                <ul class="text-xs sm:text-sm space-y-1">
                    <template x-for="item in ibanHistory" :key="item.iban">
                        <li class="font-mono text-gray-700">
                            <span x-text="item.iban"></span> – <span x-text="item.bank"></span>
                        </li>
                    </template>
                </ul>
            </div>
        </template>
    </div>

    <!-- Footer -->
    <footer class="fixed bottom-4 left-4 text-xs text-gray-500">
        Developed by 
        <a href="https://github.com/a-almazyad" target="_blank" class="underline hover:text-black font-medium">
            @a-almazyad
        </a>
    </footer>

    <!-- AlpineJS Logic -->
    <script>
        function ibanApp() {
            return {
                generatedIban: null,
                ibanHistory: [],
                showToast: false,
                toastMessage: '',

                loadHistory() {
                    const stored = JSON.parse(localStorage.getItem('ibanHistory') || '[]');
                    this.ibanHistory = stored;
                },

                generateIban() {
                    fetch('/api/generate')
                        .then(res => res.json())
                        .then(data => {
                            this.generatedIban = data;
                            this.ibanHistory.unshift({ iban: data.iban, bank: data.bank });
                            this.ibanHistory = this.ibanHistory.slice(0, 5);
                            localStorage.setItem('ibanHistory', JSON.stringify(this.ibanHistory));
                        });
                },

                copyIban() {
                    const ibanText = document.getElementById('iban-text');
                    navigator.clipboard.writeText(ibanText.innerText).then(() => {
                        this.showToastMessage('IBAN copied to clipboard!');
                    });
                },

                clearHistory() {
                    this.ibanHistory = [];
                    localStorage.removeItem('ibanHistory');
                    this.showToastMessage('History cleared');
                },

                showToastMessage(msg) {
                    this.toastMessage = msg;
                    this.showToast = true;
                    setTimeout(() => this.showToast = false, 2000);
                }
            }
        }
    </script>

</body>
</html>