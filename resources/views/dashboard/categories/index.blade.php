@extends('layouts.dashboard')
@section('title','Catgories')
@section('braedceumd')
@parent
<i class="braedceumd-item active">Catgories</i>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            @can('categories.create')
                <h3 class="card-title mt-2">categories Table</h3>
                <a href="{{route('dashboard.categories.create')}}"
                class="btn btn-success float-right mr-2">create</a>
                <a href="{{route('dashboard.categories.trash')}}"
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
            <thead >
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Name</th>
                        <th>image</th>
                        <th >Parent</th>
                        <th >count Products</th>
                        <th >status</th>
                        <th >Create At</th>
                    </tr>
            </thead>
            <tbody>
                    @forelse ( $categories as $category )

                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td><img style="width: 60px ; height:60px ;"
                                src="{{Storage::url($category->image)}}" alt="">
                            </td>
                            <td>{{$category->parent->name}}</td>
                            <td>{{$category->products_count}}</td>
                            <td>{{$category->status}}</td>
                            <td>{{$category->created_at}}</td>
                            <td>
                                <div class="btn-group">
                                    @can('categories.update')
                                    <a href="{{route('dashboard.categories.edit',$category->id )}}"
                                        class="btn btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('categories.delete')
                                    <a href="{{route('dashboard.categories.show',$category->id )}}"
                                        class="btn btn-warning ">
                                        <i class="fab fa-elementor"></i>
                                    </a>
                                    @endcan
                                    @can('categories.delete')
                                    <form action="{{route('dashboard.categories.destroy',$category->id)}}" method="POST">
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
                            <td colspan="9">No categories defined</td>
                        </tr>
                    @endforelse
            </tbody>
       </table>
     </div>
   </div>
 </div>
 {{ $categories->withQueryString()->links() }}
@endsection
