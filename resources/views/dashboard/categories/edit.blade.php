@extends('layouts.dashboard')
@section('title','edit Catgories')
@section('braedceumd')
 @parent
 <i class="braedceumd-item active">Catgories</i>
@endsection
@section('content')
<div class="col-12">
    <form action="{{ route('dashboard.categories.update',$category->id) }}" method="post"
        enctype="multipart/form-data" >
       @method('PUT')
        @csrf
        @include('dashboard.categories._form',
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
