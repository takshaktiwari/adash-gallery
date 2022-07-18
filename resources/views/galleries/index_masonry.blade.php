<x-app-layout>
    @push('styles')
        <style>
            .featured_gallery {
                background-color: #f3f3f3;
            }
        </style>
    @endpush

    <x-breadcrumb title="Galleries" :links="[['text' => 'Galleries']]" />

    <section class="featured_gallery py-5">
        <div class="container py-2">
            <h2 class="mb-4">Featured Galleries</h2>
            <div class="row g-3" data-masonry='{"percentPosition": true }'>
                @foreach ($featuredGalleries as $gallery)
                    <div class="col-xl-3 col-md-4 col-sm-6">
                        <x-agallery-gallery-card :gallery="$gallery" :masonry="true" lines="3" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="py-5" style="background-color: #f3f3f3">
        <div class="container py-2">
            <h2 class="mb-4">Other Collections</h2>
            <div class="row g-3" data-masonry='{"percentPosition": true }'>
                @foreach ($otherGalleries as $gallery)
                    <div class="col-xl-3 col-md-4 col-6">
                        <x-agallery-gallery-card :gallery="$gallery" lines="3" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
    @endpush
</x-app-layout>
