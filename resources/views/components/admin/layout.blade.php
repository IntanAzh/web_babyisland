{{-- resources/views/components/layout-admin.blade.php --}}
<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ url('/img/favicon.png') }}">
    <title>{{ $title }} - Admin - Baby Island</title>


    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="h-full bg-gray-100 font-sans">
    <div class="min-h-full min-w-full">
        <x-admin.navbar></x-admin.navbar>

        <div class="flex">

            <x-admin.sidebar></x-admin.sidebar>
            <main>
                <div class="p-41">

                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>

</html>
