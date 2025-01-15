@extends('layouts.dashboard')
@section('title','Roles')
@section('braedceumd')
@parent
<i class="braedceumd-item active">Roles</i>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title mt-2">roles Table</h3>
            {{-- @can('roles.create') --}}
            <a href="{{route('dashboard.roles.create')}}"
            class="btn btn-success float-right mr-2">create</a>
            {{-- @endcan --}}
          </div>
     <div class="card-body">
        <x-alert  type="success"/>
        <x-alert  type="info"/>
       <table class="table">
            <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Name</th>
                        <th >Create At</th>

                    </tr>
            </thead>
            <tbody>
                    @forelse ( $roles as $role )
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->created_at}}</td>
                            <td>
                                <div class="btn-group">
                                        @can('roles.update')
                                        <a href="{{route('dashboard.roles.edit',$role->id )}}"
                                            class="btn btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endcan
                                        @can('roles.delete')
                                        <form action="{{route('dashboard.roles.destroy',$role->id)}}" method="POST">
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
                            <td colspan="4">No roles defined</td>
                        </tr>
                    @endforelse
            </tbody>
       </table>
     </div>
   </div>
 </div>
 {{ $roles->withQueryString()->links() }}
@endsection
