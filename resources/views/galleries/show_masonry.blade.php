<x-app-layout>
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
        <style>
            .featured_gallery {
                background-color: #f3f3f3;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
    @endpush

    <x-breadcrumb title="Gallery Items" :links="[['text' => 'Galleries', 'url' => route('galleries.index', ['layout' => request('layout')])], ['text' => $gallery->name]]" />

    <section class="py-5">
        <div class="container py-2">
            <h2 class="mb-0">{{ $gallery->name }}</h2>
            <p class="fs-5">{{ $gallery->description }}</p>

            <div class="row g-3 mt-4" data-masonry='{"percentPosition": true }'>
                @foreach ($galleryItems as $item)
                    <div class="col-lg-3 col-md-4 col-6">
                        <a data-fancybox="gallery" data-src="{{ $item->image_lg() }}"
                            data-caption="<div class='text-center'>{{ $item->title }}<div class='small'>{{ $item->description }}</div></div>">
                            <img src="{{ $item->image_md() }}" alt="item image" class="rounded w-100">
                        </a>
                    </div>
                @endforeach
            </div>

            @if ($galleryItems->hasPages())
                <div class="text-center mt-4">
                    {{ $galleryItems->links() }}
                </div>
            @endif
        </div>
    </section>

    <section class="featured_gallery py-5">
        <div class="container py-2">
            <h2 class="mb-4">Featured Galleries</h2>
            <div class="row g-3" data-masonry='{"percentPosition": true }'>
                @foreach ($featuredGalleries as $gallery)
                    <div class="col-xl-3 col-md-4 col-6">
                        <x-agallery-gallery-card :gallery="$gallery" :masonry="true" lines="3" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>
