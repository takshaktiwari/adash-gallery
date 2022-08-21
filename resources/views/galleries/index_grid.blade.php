<x-app-layout>

    <x-breadcrumb title="Galleries" :links="[['text' => 'Galleries']]" />

    <x-agallery-featured-galleries />

    @if ($otherGalleries->count())
        <section class="py-5">
            <div class="container py-2">
                <h2 class="mb-4">Other Collections</h2>
                <div class="row g-3">
                    @foreach ($otherGalleries as $gallery)
                        <div class="col-xl-3 col-md-4 col-6">
                            <x-agallery-gallery-card :gallery="$gallery" />
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
</x-app-layout>
