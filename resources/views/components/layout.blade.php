<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mosphere</title>

    {{-- for HMR --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 dark:bg-slate-800">
    {{-- render navbar from navbar.blade.php --}}
    <x-navbar />

    {{-- render all x-content inside this slot --}}
    <div class="mt-3 mx-4 text-gray-900 dark:text-white">
        {{ $slot }}
    </div>
</body>

</html>
