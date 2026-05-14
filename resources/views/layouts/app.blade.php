<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seoTitle ?? 'SANTA-PRIZE — Оренда спецтехніки та професійні послуги' }}</title>
    <meta name="description" content="{{ $seoDescription ?? 'SANTA-PRIZE — оренда будівельної та спеціалізованої техніки для виконання різноманітних робіт.' }}" />
    @if(!empty($seoKeywords))
        <meta name="keywords" content="{{ $seoKeywords }}" />
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-foreground font-sans antialiased">
    <div class="min-h-screen bg-background flex flex-col">
        @include('partials.header')
        
        <main class="flex-grow">
            @yield('content')
        </main>
        
        @include('partials.footer')
    </div>
</body>
</html>
