@php
    $navItems = [
        ['label' => 'Головна', 'href' => route('home')],
        ['label' => 'Спецтехніка', 'href' => route('equipments.index')],
        ['label' => 'Послуги', 'href' => route('services.index')],
        ['label' => 'Об\'єкти', 'href' => route('projects.index')],
        ['label' => 'Контакти', 'href' => '#contact'],
    ];
@endphp

<header id="main-header"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 bg-transparent border-transparent">
    <div class="container mx-auto flex items-center justify-between h-20 px-6">
        <a href="/" class="text-foreground text-xl font-semibold tracking-[0.2em] uppercase">
            SANTA-PRIZE
        </a>

        <!-- Desktop nav -->
        <nav class="hidden md:flex items-center gap-10">
            @foreach($navItems as $item)
                <a href="{{ $item['href'] }}"
                    class="text-muted-foreground text-sm tracking-wider uppercase hover:text-foreground transition-colors duration-300">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <!-- Mobile toggle -->
        <button id="mobile-menu-btn" class="md:hidden text-foreground" aria-label="Toggle menu" aria-expanded="false">
            <div class="space-y-1.5 relative w-6 h-[17px]">
                <span
                    class="line-1 absolute top-0 left-0 block w-6 h-px bg-foreground transition-all duration-300 origin-center"></span>
                <span
                    class="line-2 absolute top-[8px] left-0 block w-6 h-px bg-foreground transition-all duration-300"></span>
                <span
                    class="line-3 absolute bottom-0 left-0 block w-6 h-px bg-foreground transition-all duration-300 origin-center"></span>
            </div>
        </button>
    </div>

    <!-- Mobile menu -->
    <nav id="mobile-menu"
        class="md:hidden absolute top-full left-0 right-0 bg-background/95 backdrop-blur-xl border-b border-border px-6 pb-8 pt-4 transition-all duration-300 opacity-0 -translate-y-2 pointer-events-none">
        @foreach($navItems as $item)
            <a href="{{ $item['href'] }}"
                class="block py-3 text-muted-foreground text-sm tracking-wider uppercase hover:text-foreground transition-colors">
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>
</header>