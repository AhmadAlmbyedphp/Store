  
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
        <x-form.input label="store Name"
        name="name" :value="$store->name"/>
    </div> 
    {{-- descripition--}}
    <div class="form-group">
        <x-form.textarea  label="store Description" 
        name="description" :value="$store->description"/>
    </div>
    {{-- iogo_image --}}
    <div class="form-group">
        <label for="exampleInputFile">store iogo</label>
        <div class="input-group">
        <div class="custom-file"> 
        <input name="iogo_image" accept="image/*"
            type="file" class="custom-file-input" id="exampleInputFile">    
        <label class="custom-file-label" for="exampleInputFile">store iogo
        </div>  
        <div  class="input-group-append">
        <span class="input-group-text">Upload</span>
        </div>
        </div>
        @if($store->iogo_image)
        <img style="width: 60px ; height:60px ;"
        src="{{Storage::url($store->iogo_image)}}" alt="">                
        @endif
    </div>
    {{-- cover_image --}}
    <div class="form-group">
        <label for="exampleInputFile">store Image</label>
        <div class="input-group">
        <div class="custom-file"> 
        <input name="cover_image" accept="image/*"
            type="file" class="custom-file-input" id="exampleInputFile">    
        <label class="custom-file-label" for="exampleInputFile">store Image</label>
        </div>  
        <div  class="input-group-append">
        <span class="input-group-text">Upload</span>
        </div>
        </div>
        @if($store->cover_image) 
        <img style="width: 60px ; height:60px ;"
        src="{{Storage::url($store->cover_image)}}" alt="">                
        @endif
    </div>
    {{-- status --}}
    <div class="form-group">
      <label>Status</label>  
      <x-form.radio name="status" :checked="$store->status" 
        :options="['active' => 'Active', 'archived' => 'Archived']"/>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $button_label?? 'save'}}</button>
</div>