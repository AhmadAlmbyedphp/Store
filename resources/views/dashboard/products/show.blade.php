@extends('layouts.dashboard')
@section('title',$product->name)
@section('braedceumd')
 @parent
 <i class="braedceumd-item active">{{ $product->name }}</i>
@endsection
@section('content')
    <div class="col-12">
        <table class="table table-bordered">
            <thead >
                    <tr>
                        <th>Name</th>
                        <th>image</th>
                        <th >ٍStore</th>
                        <th >status</th>
                        <th >Create At</th>
                    </tr>
            </thead>
            <tbody>
                @php
                $products = $product->category()->latest()->paginate(4);
                @endphp

                    @forelse ($products as $product )
                        <tr>
                            <td>{{$product->name}}</td>
                            <td><img style="width: 60px ; height:60px ;"
                                src="{{Storage::url($product->image)}}" alt="">
                            </td>
                            <td>{{$product->store}}</td>
                            <td>{{$product->status}}</td>
                            <td>{{$product->created_at}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No product defined</td>
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
{{ $products->links() }}
@endsection
