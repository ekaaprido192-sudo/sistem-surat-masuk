<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Sistem Surat BKAD') }}</title>

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        
        <!-- Header Top Right Menu -->
        <header class="w-full lg:max-w-4xl max-w-xs text-sm mb-6">
            <nav class="flex items-center justify-end gap-4">
                <a
                    href="/admin/login"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-gray-300 dark:border-[#3E3E3A] hover:border-black dark:hover:border-white rounded-sm text-sm leading-normal"
                >
                    Log in Admin
                </a>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="flex max-w-xs w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
            <div class="text-[13px] leading-5 flex-1 p-6 pb-6 lg:p-20 lg:pb-10 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-sm rounded-lg border border-gray-200 dark:border-[#3E3E3A]">
                <h1 class="mb-2 font-semibold text-lg text-gray-900 dark:text-white">
                    Sistem Pengolahan Data Surat Masuk & Disposisi
                </h1>
                <p class="mb-6 text-[#706f6c] dark:text-[#A1A09A]">
                    Selamat datang di Portal Pengolahan Data Surat BKAD. Silakan masuk ke halaman panel admin untuk mengelola surat masuk, disposisi, dan mencetak laporan PDF.
                </p>

                <div>
                    <a href="/admin" class="inline-block dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white hover:bg-black px-5 py-2.5 bg-[#1b1b18] rounded-md text-white text-sm font-semibold transition-all">
                        Masuk ke Panel Admin &rarr;
                    </a>
                </div>
            </div>
        </main>

    </body>
</html>
