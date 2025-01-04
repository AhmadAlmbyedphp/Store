@extends('layouts.dashboard')
@section('title','new products')
@section('braedceumd')
 @parent
 <i class="braedceumd-item active">products</i>
@endsection
@section('content')
<div class="col-12">
    <form action="{{ route('dashboard.products.store') }}" method="POST"
    enctype="multipart/form-data">
        @csrf
        @include('dashboard.products._form')
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
