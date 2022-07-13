<x-admin.layout>
    <x-admin.breadcrumb title='Galleries' :links="[
			['text' => 'Dashboard', 'url' => route('admin.dashboard') ],
            ['text' => 'Galleries Items', 'url' => route('admin.galleries.index')],
            ['text' => 'Edit']
		]" :actions="[
            ['text' => 'Galleries', 'icon' => 'fas fa-list', 'url' => route('admin.galleries.index') ],
            ['text' => 'Items', 'icon' => 'fas fa-list', 'url' => route('admin.galleries-items.index') ],
        ]" />

    <form action="{{ route('admin.galleries-items.update', [$galleries_item]) }}" method="POST" class="card shadow-sm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body table-responsive">
            <div class="form-group">
                <label for="">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" placeholder="Enter item title" value="{{ old('title', $galleries_item->title) }}" required>
            </div>
            <div class="form-group">
                <label for="">Description </label>
                <textarea name="description" rows="2" class="form-control">{{ old('description', $galleries_item->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="">Galleries <span class="text-danger">*</span></label>
                <select name="galleries[]" id="galleries" class="form-control" multiple>
                    <option value="">-- Select --</option>
                    @foreach($galleries as $gallery)
                        <option value="{{ $gallery->id }}" {{ in_array($gallery->id, old('galleries', $galleries_item->galleries->pluck('id')->toArray())) ? 'selected' : '' }}>
                            {{ $gallery->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label for="">Item Type <span class="text-danger">*</span></label>
                        <select name="item_type" class="form-control" required>
                            <option value="">-- Select --</option>
                            <option value="image" {{ (old('item_type', $galleries_item->item_type) == 'image') ? 'selected' : '' }} >Image</option>
                            <option value="video" {{ (old('item_type', $galleries_item->item_type) == 'video') ? 'selected' : '' }} >Video</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label for="">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control" required>
                            <option value="">-- Select --</option>
                            <option value="1" {{ (old('status', $galleries_item->status) == '1') ? 'selected' : '' }} >Active</option>
                            <option value="0" {{ (old('status', $galleries_item->status) == '0') ? 'selected' : '' }} >Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="d-flex">
                        <div class="me-2">
                            <img src="{{ $galleries_item->image_sm() }}" alt="image" class="rounded" style="max-height: 65px">
                        </div>
                        <div class="form-group flex-fill">
                            <label for="">Image / Thumbnail <span class="text-danger">*</span> </label>
                            <input type="file" name="image" class="form-control">
                            <span class="small">Image dimensions: <b>Width: </b>{{ $galleries_item->galleries->first()->item_img_width }} x <b>Height: </b>{{ $galleries_item->galleries->first()->item_img_height }}</span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="form-group" id="youtube_url_block" style="display: {{ ($galleries_item->item_type == 'image') ? 'none' : '' }};">
                <label for="">Youtube Url <span class="text-danger">*</span></label>
                <input type="url" name="youtube_url" class="form-control" placeholder="Enter Youtube Url" value="{{ old('youtube_url', $galleries_item->youtube_url) }}" {{ ($galleries_item->item_type == 'image') ? '' : 'required' }}>
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
            $(document).ready(function () {
                $("select[name='item_type']").change(function (e) {
                    e.preventDefault();
                    if($(this).val() == 'video'){
                        $("#youtube_url_block input[name='youtube_url']").attr('required', '');
                        $("#youtube_url_block").slideDown('fast');
                    }else{
                        $("#youtube_url_block input[name='youtube_url']").removeAttr('required');
                        $("#youtube_url_block").slideUp('down');
                    }
                });
            });
        </script>
    @endpush
</x-admin.layout>
