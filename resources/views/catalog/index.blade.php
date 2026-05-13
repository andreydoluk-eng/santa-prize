@extends('layouts.app', ['seoTitle' => $seoTitle ?? $entityTitle, 'seoDescription' => $seoDescription ?? null])

@section('content')
    <section class="max-w-7xl mx-auto px-4 py-12 mt-12">
        {{ Breadcrumbs::render(Route::currentRouteName()) }}
        <h1 class="text-3xl my-12">{{ $entityTitle }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach($items as $item)
                <div class="group animate-on-scroll" style="transition-delay: {{ $loop->index * 200 }}ms">
                    <div class="overflow-hidden mb-8">
                        <a href="{{ route('equipments.show', $item->slug) }}" class="block">
                            <picture>
                                @if($item->main_image)
                                    <source
                                        srcset="{{ asset('storage/' . preg_replace('/\.[^.]+$/', '', $item->main_image) . '.webp') }}"
                                        type="image/webp">
                                    <img src="{{ asset('storage/' . $item->main_image) }}" alt="{{ $item->title }}" loading="lazy"
                                        width="800" height="600"
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
                                href="{{ route($entityRoute, $item->slug) }}">{{ $item->title }}</a></h3>
                        @if($item->price)
                            <span class="text-muted-foreground text-sm">{{ $item->price }} грн/год</span>
                        @endif
                    </div>
                    <div class="flex justify-between">
                        <a href="#" data-title="{{ $item->title }}"
                            data-image="{{ $item->main_image ? asset('storage/' . $item->main_image) : '' }}"
                            data-url="{{ route('applications.store') }}"
                            class="order-btn text-primary text-[11px] tracking-[0.3em] uppercase hover:text-foreground transition-colors duration-300">
                            Замовити
                        </a>
                        <a href="{{ route($entityRoute, $item->slug) }}"
                            class="text-primary text-[11px] tracking-[0.3em] uppercase hover:text-foreground transition-colors duration-300">
                            Детальніше
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection