<x-admin.layout>
    <x-admin.breadcrumb title='Galleries' :links="[['text' => 'Dashboard', 'url' => route('admin.dashboard')], ['text' => 'Galleries']]" :actions="[['text' => 'Create New', 'icon' => 'fas fa-plus', 'url' => route('admin.galleries.create')]]" />

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($galleries as $key => $gallery)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <a href="{{ route('admin.galleries.show', [$gallery]) }}">
                                    <img src="{{ $gallery->image_sm() }}" alt="gallery cover" style="height: 50px;">
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.galleries.show', [$gallery]) }}">
                                    {{ $gallery->name }}
                                </a>
                                <span class="badge bg-dark">{{ $gallery->gallery_items_count }}</span>
                            </td>
                            <td>
                                @if ($gallery->status)
                                    <span class="text-success fw-bold">(Active)</span>
                                @else
                                    <span class="text-danger">(Inactive)</span>
                                @endif
                            </td>
                            <td>
                                @if ($gallery->featured)
                                    <span class="text-primary fw-bold">(Featured)</span>
                                @else
                                    <span class="text-info">(Not Featured)</span>
                                @endif
                            </td>
                            <td class="font-size-20">
                                <a href="{{ route('admin.galleries-items.index', ['gallery_id' => $gallery->id]) }}"
                                    class="btn btn-sm btn-info" title="Slides">
                                    <i class="fas fa-images"></i>
                                </a>

                                <a href="{{ route('admin.galleries.edit', [$gallery]) }}" class="btn btn-sm btn-success"
                                    title="Edit this">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.galleries.destroy', [$gallery]) }}" method="POST"
                                    class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Delete this"
                                        onclick="return confirm('Are you sure to delete ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin.layout>
