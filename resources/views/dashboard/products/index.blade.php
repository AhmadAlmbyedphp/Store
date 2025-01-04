    @extends('layouts.dashboard')
@section('title','products')
@section('braedceumd')
@parent
<i class="braedceumd-item active">products</i>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title mt-2">products Table</h3>
                @can('products.create')
                    <a href="{{route('dashboard.products.create')}}"
                    class="btn btn-success float-right mr-2">create</a>
                    <a href="{{route('dashboard.products.trash')}}"
                    class="btn btn-dark float-right">trash</a>
                @endcan
        </div>
     <div class="card-body">
        <x-alert  type="success"/>
        <x-alert  type="info"/>
        {{--search --}}
        <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
                <x-form.input name="name" placeholder="Name" :value="request('name')" class="mx-2"/>
                <select name="status" class="form-control mx-2">
                    <option value="">All</option>
                    <option value="active">Active</option>
                    <option value="archived">Archived</option>
                </select>
               <button class="btn btn-dark mx-2 ">Filter</button>
       </form>
       <table class="table">
            <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Name</th>
                        <th>image</th>
                        <th >Caytegory</th>
                        <th >Store</th>
                        <th >Quantity</th>
                        <th >status</th>
                        <th >Create At</th>
                    </tr>
            </thead>
            <tbody>
                    @forelse ( $products as $product )
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td><img style="width: 60px ; height:60px ;"
                                src="{{Storage::url($product->image)}}" alt="">
                            </td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->store->name}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->status}}</td>
                            <td>{{$product->created_at}}</td>
                            <td>
                                <div class="btn-group">
                                    @can('products.update')
                                    <a href="{{route('dashboard.products.edit',$product->id )}}"
                                        class="btn btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('products.view')
                                        <a href="{{route('dashboard.products.show',$product->id )}}"
                                            class="btn btn-warning ">
                                            <i class="fab fa-elementor"></i>
                                        </a>
                                    @endcan
                                    @can('products.delete')
                                    <form action="{{route('dashboard.products.destroy',$product->id)}}" method="POST">
                                        @csrf @method('delete')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">No products defined</td>
                        </tr>
                    @endforelse
            </tbody>
       </table>
     </div>
   </div>
 </div>
 {{ $products->withQueryString()->links() }}
@endsection
