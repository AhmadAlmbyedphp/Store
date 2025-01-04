@extends('layouts.dashboard')
@section('title','Admin')
@section('braedceumd')
@parent
<i class="braedceumd-item active">Admin</i>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            @can('admin.create')
                <h3 class="card-title mt-2">admins Table</h3>
                <a href="{{route('dashboard.admins.create')}}"
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
       <table class="table">
            <thead >
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th >status</th>
                        <th >Create At</th>
                    </tr>
            </thead>
            <tbody>
                    @forelse ( $admins as $admin )

                        <tr>
                            <td>{{$admin->id}}</td>
                            <td>{{$admin->name}}</td>
                            <td></td>
                            <td>{{$admin->status}}</td>
                            <td>{{$admin->created_at}}</td>
                            <td>
                                <div class="btn-group">
                                    @can('admin.update')
                                    <a href="{{route('dashboard.admins.edit',$admin->id )}}"
                                        class="btn btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('admin.delete')
                                    <form action="{{route('dashboard.admins.destroy',$admin->id)}}" method="POST">
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
                            <td colspan="9">No admins defined</td>
                        </tr>
                    @endforelse
            </tbody>
       </table>
     </div>
   </div>
 </div>
 {{ $admins->withQueryString()->links() }}
@endsection
