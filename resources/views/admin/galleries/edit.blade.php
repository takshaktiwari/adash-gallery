<x-admin.layout>
    <x-admin.breadcrumb title='Galleries' :links="[
			['text' => 'Dashboard', 'url' => route('admin.dashboard') ],
            ['text' => 'Galleries', 'url' => route('admin.galleries.index')],
            ['text' => 'Edit']
		]" :actions="[
            ['text' => 'Galleries', 'icon' => 'fas fa-list', 'url' => route('admin.galleries.index') ],
            ['text' => 'Create New', 'icon' => 'fas fa-plus', 'url' => route('admin.galleries.create') ],
        ]" />

    <form action="{{ route('admin.galleries.update', [$gallery]) }}" method="POST" class="card shadow-sm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body table-responsive">
            <div class="form-group">
                <label for="">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" placeholder="Enter gallery name" value="{{ old('name', $gallery->name) }}" required>
            </div>
            <div class="form-group">
                <label for="">Description </label>
                <textarea name="description" rows="2" class="form-control">{{ old('description', $gallery->description) }}</textarea>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label for="">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control" required>
                            <option value="">-- Select --</option>
                            <option value="1" {{ (old('status', $gallery->status) == '1') ? 'selected' : '' }} >Active</option>
                            <option value="0" {{ (old('status', $gallery->status) == '0') ? 'selected' : '' }} >Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label for="">Featured <span class="text-danger">*</span></label>
                        <select name="featured" class="form-control" required>
                            <option value="">-- Select --</option>
                            <option value="1" {{ (old('featured', $gallery->featured) == '1') ? 'selected' : '' }} >Featured</option>
                            <option value="0" {{ (old('featured', $gallery->featured) == '0') ? 'selected' : '' }} >Not Featured</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="d-flex">
                        <div class="mr-2">
                            <div id="image-preview">
                                <img src="{{ $gallery->image_sm() }}" alt="" class="rounded" style="max-height: 65px">
                            </div>
                        </div>
                        <div class="form-group flex-fill">
                            <label for="">Cover Image</label>
                            <input type="file" name="image" accept="image/*" class="form-control" id="crop-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body border-top">
            <div class="row">
                <div class="col-md-6">
                    <p class="fw-bold">Gallery Items</p>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Image Width <span class="text-danger">*</span></label>
                                <input type="number" name="item_img_width" class="form-control" value="{{ old('item_img_width', $gallery->item_img_width) }}" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Image Width <span class="text-danger">*</span></label>
                                <input type="number" name="item_img_height" class="form-control" value="{{ old('item_img_height', $gallery->item_img_height) }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-dark px-3">
                <i class="fas fa-save"></i> Submit
            </button>
        </div>
    </form>

    @push('scripts')
        <script>
            var previewImg = {
                height: '65px',
                rounded: '5px',
            };
            imageCropper(
                'crop-image',
                eval("{{ config('agallery.cover_image.large', 1000).' / '.config('agallery.cover_image.large', 600) }}"),
                previewImg
            );
        </script>
    @endpush
</x-admin.layout>
