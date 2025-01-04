@section('css')
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endsection
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
            <x-form.input label="Product Name"
                name="name" :value="$product->name"/>
        </div>
        {{-- product parent  --}}
        <div class="form-group">
            <label for="">Category</label>
            <select name="category_id" class="form-control form-select">
                <option value="">Primary Category</option>
                @foreach(App\Models\Category::all() as $category)
                <option value="{{ $category->id }}"
                    {{old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        {{-- descripition--}}
        <div class="form-group">
            <x-form.textarea  label="product Description" name="description" :value="$product->description"/>
        </div>
        {{-- image --}}
        <div class="form-group">
            <label for="exampleInputFile">product Image</label>
            <div class="input-group">
            <div class="custom-file">
            <input name="image" accept="image/*"
                type="file" class="custom-file-input" id="exampleInputFile">
            <label class="custom-file-label" for="exampleInputFile">product Image</label>
            </div>
            <div  class="input-group-append">
            <span class="input-group-text">Upload</span>
            </div>
            </div>
            @if($product->image)
            <img style="width: 60px ; height:60px ;"
            src="{{Storage::url($product->image)}}" alt="">
            @endif
        </div>

        <div class="form-group">
            <x-form.input label="product price"
            name="price" :value="$product->price"/>
        </div>
        <div class="form-group">
            <x-form.input label="Compare Price"
            name="compare_price" :value="$product->compare_price"/>
        </div>
        <div class="form-group">
            <x-form.input  name="tags" label="Tags" value="{{ $tags ?? '' }}"/>
        </div>
        {{-- status --}}
        <div class="form-group">
           <label>Status</label>
         <x-form.radio name="status" :checked="$product->status"
             :options="['active' => 'Active', 'draft'=>'Draft', 'archived' => 'Archived']"/>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">{{ $button_label?? 'save'}}</button>
    </div>

@section('script')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script>
var inputElm = document.querySelector('[name=tags]'),
    tagify = new Tagify (inputElm);
</script>
@endsection
