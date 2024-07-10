@vite(['resources/css/app.css', 'resources/js/app.js'])


<x-app-layout>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>招待画面</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>


<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;" class="pt-14">
        <div class="w-full max-w-md">
            <div class="p-6 rounded-lg shadow-lg mb-4 hover:-translate-y-2 hover:shadow-lg transition-transform bg-gradient-to-r from-red-200 via-red-50 to-pink-300 border-2 border-red-400">
                <h2 class="text-xl font-semibold text-center">職員を招待する</h2>
            </div>
            <a href="{{ url('/registration-confirmation') }}">
                <div class="p-6 rounded-lg shadow-lg hover:-translate-y-2 hover:shadow-lg transition-transform bg-gradient-to-r from-orange-300 via-red-50 to-yellow-100 border-2 border-yellow-400">
                    <h2 class="text-xl font-semibold text-center">家族を招待する</h2>
                </div>
            </a>
        </div>
    </div>
</body>
</html>
</x-app-layout>