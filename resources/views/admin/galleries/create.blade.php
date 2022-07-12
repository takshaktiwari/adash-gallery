<x-admin.layout>
    <x-admin.breadcrumb title='Galleries' :links="[
			['text' => 'Dashboard', 'url' => route('admin.dashboard') ],
            ['text' => 'Galleries', 'url' => route('admin.galleries.index')],
            ['text' => 'Create']
		]" :actions="[
            ['text' => 'Galleries', 'icon' => 'fas fa-list', 'url' => route('admin.galleries.index') ],
        ]" />

    <form action="{{ route('admin.galleries.store') }}" method="POST" class="card shadow-sm" enctype="multipart/form-data">
        @csrf
        <div class="card-body table-responsive">
            <div class="form-group">
                <label for="">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" placeholder="Enter gallery name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="">Description </label>
                <textarea name="description" rows="2" class="form-control">{{ old('description') }}</textarea>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label for="">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control" required>
                            <option value="">-- Select --</option>
                            <option value="1" {{ (old('status') == '1') ? 'selected' : '' }} >Active</option>
                            <option value="0" {{ (old('status') == '0') ? 'selected' : '' }} >Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label for="">Featured <span class="text-danger">*</span></label>
                        <select name="featured" class="form-control" required>
                            <option value="">-- Select --</option>
                            <option value="1" {{ (old('featured') == '1') ? 'selected' : '' }} >Featured</option>
                            <option value="0" {{ (old('featured') == '0') ? 'selected' : '' }} >Not Featured</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="">Cover Image </label>
                        <input type="file" name="image" class="form-control">
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
                                <input type="number" name="item_img_width" class="form-control" value="{{ old('item_img_width') }}" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Image Width <span class="text-danger">*</span></label>
                                <input type="number" name="item_img_height" class="form-control" value="{{ old('item_img_height') }}" required>
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
</x-admin.layout>
