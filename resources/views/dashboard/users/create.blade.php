@extends('layouts.dashboard')
@section('title','new User')
@section('braedceumd')
 @parent
 <i class="braedceumd-item active">User</i>
@endsection
@section('content')
<div class="col-12">
    <form action="{{ route('dashboard.users.store') }}" method="POST"
    enctype="multipart/form-data">
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
    <div class="form-group">
        <x-form.input label="Name" class="form-control-lg" name="name" :value="$user->name" />
    </div>
    <div class="form-group">
        <x-form.input label="Email" type="email" name="email" :value="$user->email" />
    </div>
    <fieldset>
        <legend> Roles </legend>

        @foreach ($roles as $role)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}">
            <label class="form-check-label">
                {{ $role->name }}
            </label>
        </div>
        @endforeach
    </fieldset>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Save</button>
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
