@extends('layouts.dashboard')
@section('title','edit Stores')
@section('braedceumd')
 @parent
 <i class="braedceumd-item active">Stores</i>
@endsection
@section('content')
<div class="col-12">
    <form action="{{ route('dashboard.stores.update',$store->id) }}" method="post"
        enctype="multipart/form-data">
       @method('PUT')
        @csrf
        @include('dashboard.stores._form',
        [
            'button_label'=>'Update'
        ])
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
