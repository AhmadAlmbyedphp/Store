@extends('layouts.dashboard')
@section('title','Order_item')
@section('braedceumd')
 @parent
 <i class="braedceumd-item active">Order_item</i>
@endsection
@section('content')
    <div class="col-12">
        <table class="table table-bordered">
            <thead>
                    <tr>
                        <th>Product Name</th>
                        <th >ٍStore Name</th>
                        <th >status</th>
                        <th >Create At</th>
                    </tr>
            </thead>
            <tbody>
                @php


                @endphp

                    @forelse ($orderItem as $product )
                        <tr>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->status}}</td>
                            <td>{{$product->created_at}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No categories defined</td>
                        </tr>
                    @endforelse
            </tbody>
       </table>

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
{{-- {{ $Order_item->links() }} --}}
@endsection
