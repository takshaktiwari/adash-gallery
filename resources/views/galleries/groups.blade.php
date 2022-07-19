<x-app-layout>
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
        <style>
            .odd_gallery {
                background-color: #f1f1f1;
            }
        </style>
    @endpush
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
        @if($masonry)
            <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
        @endif
    @endpush

    <x-breadcrumb title="Galleries" :links="[['text' => 'Galleries']]" />

    @foreach ($galleries as $gallery)
        <section class="py-5 {{ $loop->iteration % 2 ? 'odd_gallery' : '' }}">
            <div class="container">
                <h3 class="mb-2">
                    <a href="{{ route('galleries.show', [$gallery, 'layout' => request('masonry')]) }}">
                        {{ $gallery->name }} <i class="fas fa-external-link-alt"></i>
                    </a>
                </h3>
                <p class="lc-2">{{ $gallery->description }}</p>


                @if($masonry)
                <div class="row g-3" data-masonry='{"percentPosition": true }'>
                @else
                <div class="row g-3" >
                @endif

                    @foreach ($gallery->galleryItems->take(4) as $item)
                        <div class="col-lg-3 col-md-4 col-6">
                            <a data-fancybox="gallery" data-src="{{ $item->image_lg() }}"
                                data-caption="<div class='text-center'>{{ $item->title }}<div class='small'>{{ $item->description }}</div></div>">
                                <img src="{{ $item->image_md() }}" alt="item image" class="rounded w-100">
                            </a>
                        </div>
                    @endforeach
                </div>


            </div>
        </section>
    @endforeach
    <section class="py-5">
        <div class="container">
            {{ $galleries->links() }}
        </div>
    </section>
</x-app-layout>
