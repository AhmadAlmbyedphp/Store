@extends('layouts.dashboard')
@section('title',' Trash Oorder')
@section('braedceumd')
@parent
<i class="braedceumd-item active">order</i>
<i class="braedceumd-item active">Trash </i>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title mt-2">orders Trash</h3>
            <a href="{{route('dashboard.orders.index')}}" x
            class="btn btn-success float-right"> orders</a>
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
                        <th>store_id</th>
                        <th>user_id</th>
                        <th >payment_method</th>
                        <th >paymemt_status</th>
                        <th >deleted At</th>
                    </tr>
            </thead>
            <tbody>
                    @forelse ( $orders as $order )
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->store_id}}</td>
                            <td>{{$order->user_id}}</td>
                            <td>{{$order->payment_method}}</td>
                            <td>{{$order->paymemt_status}}</td>
                            <td>{{$order->deleted_at}}</td>
                            <td>
                                <div class="btn-group">
                                    <form action="{{route('dashboard.orders.restore',$order->id)}}" method="POST">
                                    @csrf @method('put')
                                        <button type="submit" class="btn btn-info">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </form>
                                    <form action="{{route('dashboard.orders.force-delete',$order->id)}}" method="POST">
                                    @csrf @method('delete')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No orders defined</td>
                        </tr>
                    @endforelse
            </tbody>
       </table>
     </div>
   </div>
 </div>
 {{ $orders->withQueryString()->links() }}
@endsection
