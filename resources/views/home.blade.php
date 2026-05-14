@extends('layouts.app')

@push('head')
    <link rel="preload" href="{{ asset('images/template/hero-bg.jpg') }}" as="image" fetchpriority="high">
@endpush

@section('content')

    <!-- removed hardcoded data -->

    <!-- Hero Section -->
    <section id="hero" class="relative h-screen flex items-end overflow-hidden pb-24 md:pb-32">
        <!-- Background -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/template/hero-bg.jpg') }}" alt="Будівельна техніка на об'єкті" width="1920"
                height="1080" class="w-full h-full object-cover" fetchpriority="high" loading="eager">
            <div class="absolute inset-0 bg-background/60"></div>
        </div>
@php
    $settings = \Illuminate\Support\Facades\Storage::exists('settings.json') 
        ? json_decode(\Illuminate\Support\Facades\Storage::get('settings.json'), true) 
        : [];
    $hero_subtitle = $settings['hero_subtitle'] ?? 'Надаємо в оренду будівельної та спеціалізованої техніки для виконання різноманітних робіт.';
    $about_text = $settings['about_text'] ?? 'Надаємо в оренду будівельної та спеціалізованої техніки для виконання різноманітних робіт — від земляних до висотних та дорожніх.';
@endphp

        <!-- Content -->
        <div class="relative z-10 container mx-auto px-6 md:px-12">
            <p class="text-primary text-[11px] tracking-[0.5em] uppercase mb-8 animate-on-scroll delay-200">
                Оренда спецтехніки та професійні послуги
            </p>

            <h1
                class="text-5xl md:text-7xl lg:text-[6.5rem] font-semibold tracking-[0.08em] text-foreground leading-none mb-10 animate-on-scroll delay-400">
                SANTA-PRIZE
            </h1>

            <p
                class="text-muted-foreground text-base md:text-lg max-w-lg leading-relaxed mb-14 animate-on-scroll delay-800">
                {{ $hero_subtitle }}
            </p>

            <div class="flex items-center gap-6 animate-on-scroll delay-1000">
                <a href="#equipment"
                    class="px-10 py-4 bg-foreground text-background text-[11px] tracking-[0.25em] uppercase hover:bg-primary hover:text-primary-foreground transition-all duration-500">
                    Оренда техніки
                </a>
                <a href="#contact"
                    class="text-muted-foreground text-[11px] tracking-[0.25em] uppercase hover:text-foreground transition-colors duration-500">
                    Зв'язатися →
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 md:py-36">
        <div class="container mx-auto px-6 md:px-12">
            <div class="max-w-2xl animate-on-scroll">
                <p class="text-primary text-[11px] tracking-[0.5em] uppercase mb-10">Про компанію</p>
                <h2 class="text-2xl md:text-4xl font-light text-foreground leading-[1.4] tracking-wide">
                    {{ $about_text }}
                </h2>
            </div>
        </div>
    </section>

    <!-- Equipment Section -->
    <section id="equipment" class="py-24 md:py-36 border-t border-border">
        <div class="container mx-auto px-6 md:px-12">
            <div class="mb-20 animate-on-scroll">
                <p class="text-primary text-[11px] tracking-[0.5em] uppercase">Спецтехніка</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($equipments as $item)
                    <div class="group animate-on-scroll" style="transition-delay: {{ $loop->index * 200 }}ms">
                        <div class="overflow-hidden mb-8">
                            <a href="{{ route('equipments.show', $item->slug) }}" class="block">
                                <picture>
                                    @if($item->main_image)
                                        <source
                                            srcset="{{ asset('storage/' . preg_replace('/\.[^.]+$/', '', $item->main_image) . '.webp') }}"
                                            type="image/webp">
                                        <img src="{{ asset('storage/' . $item->main_image) }}" alt="{{ $item->title }}"
                                            loading="lazy" width="800" height="600"
                                            class="w-full aspect-[4/3] object-cover transition-transform duration-700 group-hover:scale-[1.03]">
                                    @else
                                        <img src="{{ asset('images/template/equipment-' . (($loop->index % 3) + 1) . '.jpg') }}"
                                            alt="{{ $item->title }}" loading="lazy" width="800" height="600"
                                            class="w-full aspect-[4/3] object-cover transition-transform duration-700 group-hover:scale-[1.03]">
                                    @endif
                                </picture>
                            </a>
                        </div>
                        <div class="flex items-baseline justify-between mb-3">
                            <h3 class="text-foreground text-base font-medium tracking-wide"><a
                                    href="{{ route('equipments.show', $item->slug) }}">{{ $item->title }}</a></h3>
                            @if($item->price)
                                <span class="text-muted-foreground text-sm">{{ $item->price }} грн/год</span>
                            @endif
                        </div>
                        <div class="flex justify-between">
                            <a href="#" data-title="{{ $item->title }}"
                                data-image="{{ $item->main_image ? asset('storage/' . $item->main_image) : '' }}"
                                data-url="{{ route('applications.store') }}"
                                class="order-btn text-primary text-[11px] tracking-[0.3em] uppercase hover:text-foreground transition-colors duration-300">
                                Оренда
                            </a>
                            <a href="{{ route('equipments.show', $item->slug) }}"
                                class="text-primary text-[11px] tracking-[0.3em] uppercase hover:text-foreground transition-colors duration-300">
                                Детальніше
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-20 animate-on-scroll delay-800">
                <a href="{{ route('equipments.index') }}"
                    class="text-muted-foreground text-[11px] tracking-[0.3em] uppercase hover:text-foreground transition-colors duration-500">
                    Дивитися більше →
                </a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-24 md:py-36 border-t border-border">
        <div class="container mx-auto px-6 md:px-12">
            <div class="max-w-2xl mb-20 animate-on-scroll">
                <p class="text-primary text-[11px] tracking-[0.5em] uppercase mb-10">Послуги</p>
                <p class="text-muted-foreground text-lg leading-relaxed">
                    Надаємо професійні послуги в галузі енергетики, будівництва, виробництва та інших напрямках.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($services as $service)
                    <div class="group relative overflow-hidden border border-border animate-on-scroll"
                        style="transition-delay: {{ 150 + $loop->index * 80 }}ms">

                        <picture>
                            @if($service->main_image)
                                <source
                                    srcset="{{ asset('storage/' . preg_replace('/\.[^.]+$/', '', $service->main_image) . '.webp') }}"
                                    type="image/webp">
                                <img src="{{ asset('storage/' . $service->main_image) }}" alt="{{ $service->title }}" loading="lazy"
                                    width="800" height="600"
                                    class="w-full aspect-[4/3] object-cover transition-transform duration-700 group-hover:scale-[1.03]">
                            @else
                                <img src="{{ asset('images/template/service-' . (($loop->index % 3) + 1) . '.jpg') }}"
                                    alt="{{ $service->title }}" loading="lazy" width="800" height="600"
                                    class="w-full aspect-[4/3] object-cover transition-transform duration-700 group-hover:scale-[1.03]">
                            @endif
                        </picture>
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-background/90 via-background/40 to-background/10 group-hover:from-background/95 transition-colors duration-500">
                        </div>
                        <div class="absolute inset-0 p-6 md:p-7 flex flex-col justify-between">
                            <span
                                class="text-foreground/60 text-xs tabular-nums tracking-[0.3em]">{{ sprintf('%02d', $loop->iteration) }}</span>
                            <div class="flex flex-col gap-5">
                                <span
                                    class="text-foreground text-base md:text-lg font-light tracking-wide">{{ $service->title }}</span>
                                <a href="{{ route('services.show', $service->slug) }}"
                                    class="inline-flex items-center gap-2 self-start border-b border-foreground/30 pb-1 text-[10px] tracking-[0.4em] uppercase text-foreground/80 hover:text-primary hover:border-primary transition-colors duration-300 after:absolute after:inset-0">
                                    Деталі <span aria-hidden="true" class="text-foreground/50">→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-20 animate-on-scroll delay-800">
                <a href="{{ route('services.index') }}"
                    class="text-muted-foreground text-[11px] tracking-[0.3em] uppercase hover:text-foreground transition-colors duration-500">
                    Дивитися більше →
                </a>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-24 md:py-36 border-t border-border">
        <div class="container mx-auto px-6 md:px-12">
            <div class="mb-20 animate-on-scroll">
                <p class="text-primary text-[11px] tracking-[0.5em] uppercase">Об'єкти</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($projects as $index => $project)
                    <div class="group relative overflow-hidden animate-on-scroll"
                        style="transition-delay: {{ $index * 200 }}ms">
                        <a href="{{ route('projects.show', $project->slug ?? '') }}" class="block">
                            <picture>
                                @if($project->main_image)
                                    <source
                                        srcset="{{ asset('storage/' . preg_replace('/\.[^.]+$/', '', $project->main_image) . '.webp') }}"
                                        type="image/webp">
                                    <img src="{{ asset('storage/' . $project->main_image) }}" alt="{{ $project->title }}"
                                        loading="lazy" width="800" height="600"
                                        class="w-full aspect-[4/3] object-cover transition-transform duration-700 group-hover:scale-[1.03]">
                                @else
                                    <img src="{{ asset('images/template/equipment-' . (($loop->index % 3) + 1) . '.jpg') }}"
                                        alt="{{ $item->title }}" loading="lazy" width="800" height="600"
                                        class="w-full aspect-[4/3] object-cover transition-transform duration-700 group-hover:scale-[1.03]">
                                @endif
                            </picture>




                            <div
                                class="absolute inset-0 bg-background/30 group-hover:bg-background/10 transition-colors duration-500">
                            </div>
                            <div class="absolute bottom-0 left-0 p-6">
                                <p class="text-foreground/80 text-xs tracking-[0.2em] uppercase">{{ $project->title }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-20 animate-on-scroll delay-800">
                <a href="{{ route('projects.index') }}"
                    class="text-muted-foreground text-[11px] tracking-[0.3em] uppercase hover:text-foreground transition-colors duration-500">
                    Дивитися більше →
                </a>
            </div>
        </div>
    </section>

@endsection