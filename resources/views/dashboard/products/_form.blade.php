<div class="form-group">
    <x-form.input name="name" :value="$product->name" type="text" class="form-control-lg" label="Product Name" />

</div>

<div class="form-group">
    <label for="">Category</label>
    <select class="form-control form-select" name="category_id">
        <option value="">Category</option>
        @foreach (App\Models\Category::all() as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <x-form.label for="">Description</x-form.label>
    {{-- <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea> --}}
    <x-form.textarea name="description" class="form-control" :value="$product->description" />
</div>

<div class="form-group">
    <x-form.input name="price" type="text" label="Price" :value="$product->price" />
    <x-form.input name="compare_price" type="text" label="compare_price" :value="$product->compare_price" />
</div>

<div class="form-group">
    {{-- <x-form.input name="tag" type="text" label="Tags" /> --}}
    <x-form.input name="tag" type="text" label="Tags" :value="$tags" />
</div>

<div class="form-group">
    <x-form.input name="image" type="file" accept="image/*" label="Image" />
    @if ($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="" height="60" width="80" />
    @endif
</div>
<div class="form-group">
    <x-form.label for="">Status</x-form.label>
    <div>
        <x-form.radio name="status" value="active" :checked="$product->status" :options="['draft' => 'Draft', 'active' => 'Active', 'archived' => 'Archived']" />
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <script>
        var inputElm = document.querySelector('[name=tags]'),
            tagify = new Tagify(inputElm);
    </script>
@endpush
