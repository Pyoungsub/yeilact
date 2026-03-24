<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="keywords" content="입시연기학원 | 예고입시연기 | 예고입시반 | 대학입시반 | 예고편입반 | 중등기초반 | 고등기초반 | 배우오디션반 | 연기학원 | 목동연기학원">
        <meta name="description" content="예일연기학원은 예고입시, 대학입시, 예고편입 및 연기기초, 배우오디션준비까지 중·고등학생을 위한 전문 연기 교육을 제공합니다. 목동역 도보 3분거리의 200평 규모 최신 시설에서 체계적인 커리큘럼을 경험해보세요. 지금 무료체험수업 접수 중입니다.">

        <meta name="thumbnail" content="https://www.yeilschool.co.kr/storage/company/present_img.jpg" alt="예일연기학원">
        <meta property="og:url" content="https://www.yeilschool.co.kr">
        <meta property="og:image" content="https://www.yeilschool.co.kr/storage/company/present_img.jpg">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="Yeil Academy">
        <meta property="og:locale" content="ko">
        <meta property="og:title" content="예고입시·대학입시·기초연기반 | 예일연기학원">
        <meta property="og:description" content="예일연기학원은 예고입시, 대학입시, 예고편입 및 연기기초, 배우오디션준비까지 중·고등학생을 위한 전문 연기 교육을 제공합니다. 목동역 도보 3분거리의 200평 규모 최신 시설에서 체계적인 커리큘럼을 경험해보세요. 지금 무료체험수업 접수 중입니다.">
        <meta property="og:country-name" content="ko">

        <meta itemprop="name" content="예일연기학원">
        <meta itemprop="image" content="https://www.yeilschool.co.kr/storage/company/present_img.jpg">
        <meta itemprop="url" content="https://www.yeilschool.co.kr">
        <meta itemprop="description" content="예일연기학원은 예고입시, 대학입시, 예고편입 및 연기기초, 배우오디션준비까지 중·고등학생을 위한 전문 연기 교육을 제공합니다. 목동역 도보 3분거리의 200평 규모 최신 시설에서 체계적인 커리큘럼을 경험해보세요. 지금 무료체험수업 접수 중입니다.">
        <meta itemprop="keywords" content="all-smartphones-new">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles -->
        @livewireStyles
        @stack('scripts')
    </head>
    <body 
        class="font-sans antialiased"
        x-data="{ scrolled: false }" 
        x-init="
            window.addEventListener('scroll', () => { scrolled = (window.scrollY > 50); });
        "
    >
        <x-banner />

        <div class="min-h-screen bg-white">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
