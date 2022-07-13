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
            <div class="row g-3">
                @foreach ($featuredGalleries as $gallery)
                    <div class="col-xl-3 col-md-4 col-6">
                        <x-agallery-gallery-card :gallery="$gallery" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="py-5" style="background-color: #f3f3f3">
        <div class="container py-2">
            <h2 class="mb-4">Other Collections</h2>
            <div class="row g-3">
                @foreach ($otherGalleries as $gallery)
                    <div class="col-xl-3 col-md-4 col-6">
                        <x-agallery-gallery-card :gallery="$gallery" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>
