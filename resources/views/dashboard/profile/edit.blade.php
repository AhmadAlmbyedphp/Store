@extends('layouts.dashboard')
@section('title','edit profile')
@section('braedceumd')
 @parent
 <i class="braedceumd-item active">profile</i>
@endsection
@section('content')
<div class="col-12">
    <x-alert  type="success"/>
    <form action="{{ route('dashboard.profile.update') }}" method="post" enctype="multipart/form-data">
      @csrf  @method('patch')
        <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="first_name" label="First Name" :value="$user->profile->first_name" />
            </div>
            <div class="col-md-6">
                <x-form.input name="last_name" label="Last Name" :value="$user->profile->last_name" />
            </div>
        </div>
         <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="birthday" type="date" label="Birthday" :value="$user->profile->birthday" />
            </div>
            <div class="col-md-6">
                <x-form.radio name="gender" label="Gender" :options="['male'=>'Male', 'female'=>'Female']" :checked="$user->profile->gender"/>
            </div>
       </div>
        <div class="form-group">
            <label for="exampleInputFile">profile Image</label>
            <div class="input-group">
            <div class="custom-file">
            <input name="image" accept="image/*"
                type="file" class="custom-file-input" id="exampleInputFile">
            <label class="custom-file-label" for="exampleInputFile">profile Image</label>
            </div>
            <div  class="input-group-append">
            <span class="input-group-text">Upload</span>
            </div>
         </div>
       <div class="form-row">
            <div class="col-md-4">
                <x-form.input name="street_address"  label="Street Address" :value="$user->profile->street_address" />
            </div>
            <div class="col-md-4">
                <x-form.input name="city" label="City" :value="$user->profile->city" />
            </div>
            <div class="col-md-4">
                <x-form.input    name="state" label="State" :value="$user->profile->state"/>
            </div>
     </div>
     <div class="form-row">
        <div class="col-md-4">
            <x-form.input name="postal_code" label="Postal Code" :value="$user->profile->postal_code" />
        </div>
        <div class="col-md-4">
            <x-form.select name="country" :options="$countries" label="Country" :selected="$user->profile->country" />
        </div>
        <div class="col-md-4">
            <x-form.select name="locale"  :options="$locales"  label="Locale" :selected="$user->profile->locale"/>
        </div>
 </div>
 <div class="card-footer">
    <button type="submit" class="btn btn-primary">Save</button>
</div>
    </form>
</div>




{{-- @section('script')
<script>
     $(function(){
        $('.select2').select2({
            tags: true,
            tokenSeparators: [',','  '], =
            theme: 'bootstrap4'
        });
    });
</script>
@endsection --}}

@endsection
