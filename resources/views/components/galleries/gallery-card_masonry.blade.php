<div {{ $attributes->merge(['class' => 'card']) }}>
    <a href="{{ route('galleries.show', [$gallery, 'layout' => 'masonry']) }}">
        <img src="{{ $gallery->image_md() }}" class="card-img-top" alt="cover image">
    </a>
    <div class="card-body">
        <h5 class="card-title flex-fill my-auto">
            <a href="{{ route('galleries.show', [$gallery, 'layout' => 'masonry']) }}" class="text-decoration-none text-dark lc-{{ $lines }}" >
                {{ $gallery->name }}
            </a>
        </h5>
    </div>
</div>
