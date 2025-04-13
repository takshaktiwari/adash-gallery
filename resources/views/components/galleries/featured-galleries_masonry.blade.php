@push('styles')
    <style>
        .featured_gallery {
            background-color: #f3f3f3;
        }
    </style>
@endpush

@if ($galleries->count())
    <section {{ $attributes->merge(['class' => 'featured_gallery py-5 ']) }}>
        <div class="container py-2">
            <h2 class="mb-4">Featured Galleries</h2>
            <div class="row g-3" data-masonry='{"percentPosition": true }'>
                @foreach ($galleries as $gallery)
                    <div class="col-xl-3 col-md-4 col-sm-6">
                        <x-agallery-agallery:gallery-card :gallery="$gallery" :masonry="true" lines="3" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
