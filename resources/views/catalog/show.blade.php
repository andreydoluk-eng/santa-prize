@extends('layouts.app', [
    'seoTitle' => $item->seo_title ?: $item->title,
    'seoDescription' => $item->seo_description,
    'seoKeywords' => $item->seo_keywords,
])

@section('content')
    <section class="max-w-7xl mx-auto px-4 py-12 mt-12">
        {{ Breadcrumbs::render(Route::currentRouteName(), $item) }}
       

        <div class="flex flex-col md:flex-row mt-12 gap-8 md:gap-0">
            <div class="w-full md:w-1/2">
                @if($item->main_image)
                    <a href="{{ asset('storage/' . $item->main_image) }}" data-fslightbox="gallery-{{ $item->slug }}">
                        <img
                            src="{{ asset('storage/' . $item->main_image) }}"
                            alt="{{ $item->title }}"
                            class="w-full border mb-6"
                            loading="lazy"
                        >
                    </a>
                @endif

                @if(!empty($item->gallery_images))
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
                        @foreach($item->gallery_images as $galleryImage)
                            <a href="{{ asset('storage/' . $galleryImage) }}" data-fslightbox="gallery-{{ $item->slug }}">
                                <img
                                    src="{{ asset('storage/' . $galleryImage) }}"
                                    alt="{{ $item->title }}"
                                    class="w-full h-36 object-cover border"
                                    loading="lazy"
                                >
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="w-full md:w-1/2 pl-0 md:pl-12">
                 <h1 class="text-2xl md:text-3xl mb-6">{{ $item->title }}</h1>
                @if($item->description)
                    <article class="prose max-w-none mb-8">{!! $item->description !!}</article>
                @endif

                @if($item->price)
                    <p class="text-2xl my-6">{{ $item->price }} грн/год</p>
                @endif

                <button data-title="{{ $item->title }}" data-image="{{ $item->main_image ? asset('storage/' . $item->main_image) : '' }}" data-url="{{ route('applications.store') }}" class="order-btn group bg-transparent text-white-800 hover:text-gray-100 py-2 px-4 border border-white hover:border-gray-100 relative inline-flex h-12 items-center justify-center overflow-hidden rounded-md  px-6 font-medium text-neutral-200 duration-500 hover:cursor-pointer"><div class="translate-y-0 transition group-hover:-translate-y-[150%]">Замовити</div><div class="absolute translate-y-[150%] transition group-hover:translate-y-0">Замовити</div></button>
            </div>
        </div>

        @if($items->isNotEmpty())
        <div class="mt-12">
            <h3 class="text-3xl mb-6">{{ $otherServices ?? '' }}</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach($items as $otherItem)
                <div class="group animate-on-scroll" style="transition-delay: {{ $loop->index * 200 }}ms">
                    <div class="overflow-hidden mb-8">
                        <a href="{{ route($entityRoute, $otherItem->slug) }}" class="block">
                            <picture>
                                @if($otherItem->main_image)
                                    <source
                                        srcset="{{ asset('storage/' . preg_replace('/\.[^.]+$/', '', $otherItem->main_image) . '.webp') }}"
                                        type="image/webp">
                                    <img src="{{ asset('storage/' . $otherItem->main_image) }}" alt="{{ $otherItem->title }}" loading="lazy"
                                        width="800" height="600"
                                        class="w-full aspect-[4/3] object-cover transition-transform duration-700 group-hover:scale-[1.03]">
                                @else
                                    <img src="{{ asset('images/template/equipment-' . (($loop->index % 3) + 1) . '.jpg') }}"
                                        alt="{{ $otherItem->title }}" loading="lazy" width="800" height="600"
                                        class="w-full aspect-[4/3] object-cover transition-transform duration-700 group-hover:scale-[1.03]">
                                @endif
                            </picture>
                        </a>
                    </div>
                    <div class="flex items-baseline justify-between mb-3">
                        <h3 class="text-foreground text-base font-medium tracking-wide"><a
                                href="{{ route($entityRoute, $otherItem->slug) }}">{{ $otherItem->title }}</a></h3>
                        @if($otherItem->price)
                            <span class="text-muted-foreground text-sm">{{ $otherItem->price }} грн/год</span>
                        @endif
                    </div>
                    <div class="flex justify-between">
                        <a href="#" data-title="{{ $otherItem->title }}"
                            data-image="{{ $otherItem->main_image ? asset('storage/' . $otherItem->main_image) : '' }}"
                            data-url="{{ route('applications.store') }}"
                            class="order-btn text-primary text-[11px] tracking-[0.3em] uppercase hover:text-foreground transition-colors duration-300">
                            Замовити
                        </a>
                        <a href="{{ route($entityRoute, $otherItem->slug) }}"
                            class="text-primary text-[11px] tracking-[0.3em] uppercase hover:text-foreground transition-colors duration-300">
                            Детальніше
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </section>
@endsection
