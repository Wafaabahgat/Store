
        <div class="form-group">
            <label for="">Category Name</label>
            <input type="text" name="name" id="" class="form-control">
        </div>

        <div class="form-group">
            <select class="form-control form-select" name="parent_id">
                <option value="">Primary Category</option>
                @foreach ($parents as $parent)
                    <option value=" {{ $parent->id }} "> {{ $parent->name }} </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        </div>

        <div class="form-group">
            <label for="">Status</label>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value="active">
                    <label class="form-check-label">
                        Active
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value="archived">
                    <label class="form-check-label">
                        Archived
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

 
