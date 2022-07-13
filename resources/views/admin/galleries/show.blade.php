<x-admin.layout>
    <x-admin.breadcrumb title='Galleries' :links="[
        ['text' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['text' => 'Galleries', 'url' => route('admin.galleries.index')],
        ['text' => 'Show'],
    ]" :actions="[
        ['text' => 'Galleries', 'icon' => 'fas fa-list', 'url' => route('admin.galleries.index')],
        ['text' => 'Create New', 'icon' => 'fas fa-plus', 'url' => route('admin.galleries.create')],
    ]" />

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 my-auto">
                    <img src="{{ $gallery->image_md() }}" alt="cover image" class="w-100 img-thumbnail">
                </div>
                <div class="col-md-8 my-auto">
                    <table class="table">
                        <tr>
                            <td><b>Name:</b></td>
                            <td>{{ $gallery->name }}</td>
                        </tr>
                        <tr>
                            <td><b>Slug:</b></td>
                            <td>{{ $gallery->slug }}</td>
                        </tr>
                        <tr>
                            <td><b>Description:</b></td>
                            <td>{{ $gallery->description }}</td>
                        </tr>
                        <tr>
                            <td><b>Status:</b></td>
                            <td>
                                {{ $gallery->status ? 'Active' : 'Inactive' }}
                                <span class="px-2">|</span>
                                {{ $gallery->featured ? 'Featured' : 'Not featured' }}
                            </td>
                        </tr>
                        <tr>
                            <td><b>Item Size:</b></td>
                            <td>
                                <b>Width: </b>{{ $gallery->item_img_width }}
                                <span class="px-2">|</span>
                                <b>Height: </b>{{ $gallery->item_img_height }}
                            </td>
                        </tr>
                        <tr>
                            <td><b>Added By:</b></td>
                            <td>{{ $gallery->user->name }}</td>
                        </tr>
                    </table>
                    <a href="{{ route('admin.galleries.edit', [$gallery]) }}" class="btn btn-success" title="Edit this">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                    <form action="{{ route('admin.galleries.destroy', [$gallery]) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" title="Delete this" onclick="return confirm('Are you sure to delete ?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="my-auto">Gallery Items</h5>
        </div>
        <div class="card-body">
            @if ($gallery->galleryItems->count())
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Item Details</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gallery->galleryItems as $item)
                            <tr>
                                <td>
                                    <img src="{{ $item->image_sm() }}" alt="item image" style="max-height: 70px" class="rounded">
                                </td>
                                <td>
                                    <div>{{ $item->title }}</div>
                                    <div class="small mb-1">{{ $item->description }}</div>

                                    <div class="text-dark"><b>Galleries: </b> {{ $item->galleries->pluck('name')->implode(', ') }}</div>

                                    @if($item->youtube_url)
                                        <a href="{{ $item->youtube_url }}" target="_blank"><b>Youtube: </b>{{ $item->youtube_url }}</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.galleries-items.edit', [$item]) }}" class="btn btn-sm btn-success" title="Edit this">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.galleries-items.destroy', [$item]) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" title="Delete this" onclick="return confirm('Are you sure to delete ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <div class="border-top mt-2 pt-1">
                                        <span class="badge font-12 bg-{{ $item->status ? 'success' : 'danger' }}">
                                            {{ $item->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center my-5">
                    <h1 class="text-center text-info mb-4">Currently, no items</h1>
                    <a href="{{ route('admin.galleries-items.create', ['gallery' => $gallery->id]) }}" class="btn btn-success px-4" target="_blank"><i class="fas fa-plus"></i> Add Item</a>
                </div>
            @endif
        </div>
    </div>
</x-admin.layout>
