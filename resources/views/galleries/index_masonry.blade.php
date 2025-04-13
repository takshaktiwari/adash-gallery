<x-app-layout>

    <x-breadcrumb title="Galleries" :links="[['text' => 'Galleries']]" />

    <x-agallery-agallery:featured-galleries :masonry="true" />

    @if ($otherGalleries->count())
        <section class="py-5">
            <div class="container py-2">
                <h2 class="mb-4">Other Collections</h2>
                <div class="row g-3" data-masonry='{"percentPosition": true }'>
                    @foreach ($otherGalleries as $gallery)
                        <div class="col-xl-3 col-md-4 col-6">
                            <x-agallery-agallery:gallery-card :gallery="$gallery" lines="3" />
                        </div>
                    @endforeach
                </div>

                @if ($otherGalleries->hasPages())
                    <div class="mt-5">
                        {{ $otherGalleries->links() }}
                    </div>
                @endif
            </div>
        </section>
    @endif

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
            integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
        </script>
    @endpush
</x-app-layout>
