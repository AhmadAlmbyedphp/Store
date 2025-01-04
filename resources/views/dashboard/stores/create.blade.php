@extends('layouts.dashboard')
@section('title','new Stores')
@section('braedceumd')
 @parent
 <i class="braedceumd-item active">Stores</i>
@endsection
@section('content')
<div class="col-12">
    <form action="{{ route('dashboard.stores.store')}}" method="POST"
    enctype="multipart/form-data">
        @csrf
        @include('dashboard.stores._form')
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
