@extends('layouts.dashboard')
@section('title','new Catgories')
@section('braedceumd')
 @parent
 <i class="braedceumd-item active">Catgories</i>
@endsection
@section('content')
<div class="col-12">
    <form action="{{ route('dashboard.categories.store') }}" method="POST"
    enctype="multipart/form-data">
        @csrf
        @include('dashboard.categories._form')
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
