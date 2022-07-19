<x-app-layout>
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
        <style>
            .gallery_banner{
                background-image: url('{{ $gallery->image_lg() }}');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                min-height: 300px;
                background-attachment: fixed;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    @endpush

    <x-breadcrumb title="Gallery Items" :links="[['text' => 'Galleries', 'url' => route('galleries.index', ['layout' => request('layout')])], ['text' => $gallery->name]]" />

    <section class="py-5">
        <div class="container py-2">
            <div class="gallery_banner rounded py-5 mb-3"></div>
            <h2 class="mb-1">{{ $gallery->name }}</h2>
            <p class="fs-5">{{ $gallery->description }}</p>
            <hr>

            <div class="row g-3 mt-4">
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

    <x-agallery-featured-galleries />
</x-app-layout>
