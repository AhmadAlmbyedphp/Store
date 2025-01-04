@extends('layouts.dashboard')
@section('title','edit products')
@section('braedceumd')
 @parent
 <i class="braedceumd-item active">products</i>
@endsection
@section('content')
<div class="col-12">
    <form action="{{ route('dashboard.products.update',$product->id) }}" method="post"
        enctype="multipart/form-data">
       @method('PUT')
        @csrf
        @include('dashboard.products._form',
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
