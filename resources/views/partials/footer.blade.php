@php
    $navItems = [
        ['label' => 'Головна', 'href' => route('home')],
        ['label' => 'Спецтехніка', 'href' => route('equipments.index')],
        ['label' => 'Послуги', 'href' => route('services.index')],
        ['label' => 'Об\'єкти', 'href' => route('projects.index')],
        ['label' => 'Контакти', 'href' => '#contact'],
    ];
@endphp


<!-- Contact Section -->
<section id="contact" class="py-24 md:py-36 border-t border-border">
    <div class="container mx-auto px-6 md:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 lg:gap-32">
            <div class="animate-on-scroll">
                <p class="text-primary text-[11px] tracking-[0.5em] uppercase mb-10">Контакти</p>
                <h2 class="text-2xl md:text-4xl font-light text-foreground tracking-wide mb-16">
                    Зв'яжіться з нами
                </h2>

                @php
                    $settings = \Illuminate\Support\Facades\Storage::exists('settings.json') 
                        ? json_decode(\Illuminate\Support\Facades\Storage::get('settings.json'), true) 
                        : [];
                    $email = $settings['email'] ?? 'info@santa-prize.com';
                    $phone = $settings['phone'] ?? '+380 (XX) XXX-XX-XX';
                @endphp

                <div class="space-y-8">
                    <div>
                        <p class="text-muted-foreground/50 text-[11px] tracking-[0.3em] uppercase mb-3">Телефон</p>
                        <p class="text-foreground text-lg font-light">{{ $phone }}</p>
                    </div>
                    <div>
                        <p class="text-muted-foreground/50 text-[11px] tracking-[0.3em] uppercase mb-3">Email</p>
                        <p class="text-foreground text-lg font-light">{{ $email }}</p>
                    </div>
                </div>
            </div>

            <form id="contact-form" action="{{ route('applications.store') }}" method="POST"
                class="space-y-10 pt-2 animate-on-scroll delay-200">
                @csrf
                <div>
                    <label
                        class="block text-muted-foreground/100 text-[11px] tracking-[0.3em] uppercase mb-4">Ім'я</label>
                    <input type="text" name="name" required
                        class="w-full bg-transparent border-b border-border text-foreground py-3 focus:outline-none focus:border-primary transition-colors duration-500 text-base font-light">
                </div>
                <div>
                    <label
                        class="block text-muted-foreground/100 text-[11px] tracking-[0.3em] uppercase mb-4">Телефон</label>
                    <input type="tel" id="contact-phone" name="phone" required
                        class="w-full bg-transparent border-b border-border text-foreground py-3 focus:outline-none focus:border-primary transition-colors duration-500 text-base font-light">
                </div>
                <div>
                    <label
                        class="block text-muted-foreground/100 text-[11px] tracking-[0.3em] uppercase mb-4">Повідомлення</label>
                    <textarea name="message" rows="3"
                        class="w-full bg-transparent border-b border-border text-foreground py-3 focus:outline-none focus:border-primary transition-colors duration-500 resize-none text-base font-light"></textarea>
                </div>
                <button type="submit"
                    class="px-10 py-4 bg-foreground text-background text-[11px] tracking-[0.25em] uppercase hover:bg-primary hover:text-primary-foreground transition-all duration-500 mt-4">
                    Надіслати
                </button>
            </form>
        </div>
    </div>
</section>

<footer class="border-t border-border py-20">
    <div class="container mx-auto px-6 md:px-12">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-10">
            <a href="#hero" class="text-foreground text-sm font-semibold tracking-[0.25em] uppercase">
                SANTA-PRIZE
            </a>
            <nav class="flex flex-wrap items-center gap-10">
                @foreach($navItems as $item)
                    <a href="{{ $item['href'] }}"
                        class="text-muted-foreground text-[11px] tracking-[0.2em] uppercase hover:text-foreground transition-colors duration-300">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
        </div>
        <div class="border-t border-border mt-16 pt-10">
            <p class="text-muted-foreground/40 text-[11px] tracking-[0.15em]">
                © {{ date('Y') }} SANTA-PRIZE
            </p>
        </div>
    </div>
</footer>