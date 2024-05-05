<div class="form-group">
    <x-form.input name="name" :value="$categories->name" type="text" class="form-control-lg" label="Category Name" />

</div>

<div class="form-group">
    <label for="">Category Parent</label>
    <select class="form-control form-select" name="parent_id">
        <option value="">Primary Category</option>
        @foreach ($parents as $parent)
            <option value="{{ $parent->id }}" @selected(old('parent_id', $categories->parent_id) == $parent->id)>
                {{ $parent->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <x-form.label for="">Description</x-form.label>
    {{-- <textarea name="description" class="form-control">{{ old('description', $categories->description) }}</textarea> --}}
    <x-form.textarea name="description" class="form-control" :value="$categories->description" />

</div>

<div class="form-group">
    <x-form.input name="image" type="file" accept="image/*" label="Image" />
    @if ($categories->image)
        <img src="{{ asset('storage/' . $categories->image) }}" alt="" height="60" width="80" />
    @endif
</div>
<div class="form-group">
    <x-form.label for="">Status</x-form.label>
    <div>
        <x-form.radio name="status" value="active" :checked="$categories->status" :options="['active' => 'Active', 'archived' => 'Archived']" />
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>
