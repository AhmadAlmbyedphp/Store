
   @if($errors->any())
        <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"
        aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Errors!</h5>
        @foreach ( $errors->all() as $error )
        <li>{{$error}}</li>
        @endforeach
        </div>
    @endif
<div class="card-body">
    {{-- name --}}
    <div class="form-group">
        <x-form.input label="Category Name"
        name="name" :value="$category->name"/>
    </div>
    {{-- Category parent  --}}
    <div class="form-group" data-select2-id="28">
        <label>Category parent</label>
        <select class="select2 select2-hidden-accessible"
                multiple="" data-placeholder="Select a State" style="width: 100%;
                margin-left: 2px ;"
                data-select2-id="6" tabindex="-1"
                aria-hidden="true" name="parent_id">
            <option value="">Primary Category</option>
            @foreach ($parents as $parent)
                <option value="{{ $parent->id }}"
                    {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                    {{ $parent->name }}
                </option>
            @endforeach
        </select>
    </div>
    {{-- descripition--}}
    <div class="form-group">
        <x-form.textarea  label="Category Description"
        name="description" :value="$category->description"/>
    </div>
    {{-- image --}}
    <div class="form-group">
        <label for="exampleInputFile">Category Image</label>
        <div class="input-group">
        <div class="custom-file">
        <input name="image" accept="image/*"
            type="file" class="custom-file-input" id="exampleInputFile">
        <label class="custom-file-label" for="exampleInputFile">Category Image</label>
        </div>
        <div  class="input-group-append">
        <span class="input-group-text">Upload</span>
        </div>
        </div>
        @if($category->image)
        <img style="width: 60px ; height:60px ;"
        src="{{Storage::url($category->image)}}" alt="">
        @endif
    </div>
    {{-- status --}}
    <div class="form-group">
      <label>Status</label>
      <x-form.radio name="status" :checked="$category->status"
        :options="['active' => 'Active', 'archived' => 'Archived']"/>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $button_label?? 'save'}}</button>
</div>
