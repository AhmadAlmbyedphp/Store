@extends('layouts.dashboard')
@section('title','edit Admin')
@section('braedceumd')
 @parent
 <i class="braedceumd-item active">Admin</i>
@endsection
@section('content')
<div class="col-12">
    <form action="{{ route('dashboard.admins.update',$admin->id) }}" method="post"
        enctype="multipart/form-data" >
       @method('PUT')
        @csrf
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
        <x-form.input label="AdminsName"
        name="name" :value="$admin->name"/>
    </div>
       {{-- Email --}}
    <div class="form-group">
        <x-form.input label="Email"
        name="email" :value="$admin->email"/>
    </div>
    <fieldset>
        <legend>Roles</legend>

        @foreach ($roles as $role)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}"
            @if(in_array($role->id, old('roles', $admin_roles))) checked @endif>
            <label class="form-check-label">
                {{ $role->name }}
            </label>
        </div>
        @endforeach
    </fieldset>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Update</button>
</div>

    </form>
</div>
@section('script')
<script>
     $(function(){
        $('.select2').select2({
            majors :true,
            tokenSepators: [',','  '],
            theme: 'bootstrap4'
    })
    })
</script>
@endsection
@endsection
