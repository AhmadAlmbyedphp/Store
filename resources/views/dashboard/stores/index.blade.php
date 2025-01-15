@extends('layouts.dashboard')
@section('title','Stores')
@section('braedceumd')
@parent
<i class="braedceumd-item active">Stores</i>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            @can('store.create')
                <h3 class="card-title mt-2">stores Table</h3>
                <a href="{{route('dashboard.stores.create')}}"
                class="btn btn-success float-right mr-2">create</a>
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
       <table class="table" >
            <thead >
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Name</th>
                        <th>Iogo_image</th>
                        <th>Cover_image</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
            </thead>
            <tbody>
                    @forelse ( $stores as $store )
                        <tr>
                            <td>{{$store->id}}</td>
                            <td>{{$store->name}}</td>
                            <td><img style="width: 60px ; height:60px ;"
                                src="{{Storage::url($store->logo_image)}}" alt="">
                            </td>
                            <td><img style="width: 60px ; height:60px ;"
                                src="{{Storage::url($store->cover_image)}}" alt="">
                            </td>
                            <td>{{$store->status}}</td>
                            <td>{{$store->created_at}}</td>
                            <td>
                                <div class="btn-group">
                                        @can('store.update')
                                        <a href="{{route('dashboard.stores.edit',$store->id )}}"
                                            class="btn btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endcan
                                        @can('store.delete')
                                        <form action="{{route('dashboard.stores.destroy',$store->id)}}" method="POST">
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
                            <td colspan="9">No stores defined</td>
                        </tr>
                    @endforelse
            </tbody>
       </table>
     </div>
   </div>
 </div>
 {{-- {{ $stores->withQueryString()->links() }} --}}
@endsection
