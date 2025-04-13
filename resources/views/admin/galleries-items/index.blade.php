<x-admin.layout>
    <x-admin.breadcrumb title='Galleries' :links="[
			['text' => 'Dashboard', 'url' => route('admin.dashboard') ],
            ['text' => 'Galleries Items', 'url' => route('admin.galleries-items.index')],
            ['text' => 'Create']
		]" :actions="[
            ['text' => 'Galleries', 'icon' => 'fas fa-list', 'url' => route('admin.galleries.index') ],
            ['text' => 'Add Items', 'icon' => 'fas fa-plus', 'url' => route('admin.galleries-items.create') ],
        ]" />

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Item Details</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($galleryItems as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
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
                                <span class="badge font-12 bg-{{ $item->status ? 'success' : 'danger' }}">
                                    {{ $item->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="text-nowrap">
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
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $galleryItems->links() }}
        </div>
    </div>
</x-admin.layout>
