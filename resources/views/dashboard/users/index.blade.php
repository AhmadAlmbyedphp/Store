@extends('layouts.dashboard')
@section('title','User')
@section('braedceumd')
@parent
<i class="braedceumd-item active">User</i>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            {{-- @can('user.create') --}}
                <h3 class="card-title mt-2">users Table</h3>
                <a href="{{route('dashboard.users.create')}}"
                class="btn btn-success float-right mr-2">create</a>
            {{-- @endcan --}}
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
                        <th>image</th>
                        <th >status</th>
                        <th >Create At</th>
                    </tr>
            </thead>
            <tbody>
                    @forelse ( $users as $user )

                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <p>{{ $role->name }}</p>
                                @endforeach
                            </td>
                            <th>
                                <img style="width: 60px ; height:60px ;"
                                src="{{Storage::url($user->profile->image)}}" alt="">
                            </th>
                            <td>{{$user->status}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                <div class="btn-group">
                                    @can('user.update')
                                    <a href="{{route('dashboard.users.edit',$user->id )}}"
                                        class="btn btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('user.delete')
                                    <form action="{{route('dashboard.users.destroy',$user->id)}}" method="POST">
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
                            <td colspan="9">No users defined</td>
                        </tr>
                    @endforelse
            </tbody>
       </table>
     </div>
   </div>
 </div>
 {{ $users->withQueryString()->links() }}
@endsection
