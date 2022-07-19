<div {{ $attributes->merge(['class' => 'card']) }}>
    <a href="{{ route('galleries.show', [$gallery, 'layout' => request('masonry')]) }}">
        <img src="{{ $gallery->image_md() }}" class="card-img-top" alt="cover image">
    </a>
    <div class="card-body d-flex">
        <h5 class="card-title flex-fill my-auto">
            <span class="lc-{{ $lines }}">{{ $gallery->name }}</span>
        </h5>
        <a href="{{ route('galleries.show', [$gallery, 'layout' => request('masonry')]) }}"
            class="btn btn-sm btn-light border">
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</div>
