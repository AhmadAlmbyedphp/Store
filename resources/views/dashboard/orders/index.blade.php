@extends('layouts.dashboard')
@section('title','order')
@section('braedceumd')
@parent
<i class="braedceumd-item active">order</i>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <a href="{{route('dashboard.orders.trash')}}"
            class="btn btn-dark float-right">trash</a>
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
                        <th>store_id</th>
                        <th>user_name</th>
                        <th >payment_method</th>
                        <th >paymemt_status</th>
                        <th >created_at </th>
                    </tr>
            </thead>
            <tbody>
                    @forelse ( $orders as $order )
                        <tr>
                            <td>{{$order->store_id}}</td>
                            <td>{{$order->user->name}}</td>
                            <td>{{$order->payment_method}}</td>
                            <td>{{$order->paymemt_status}}</td>
                            <td>{{$order->created_at}}</td>
                            <td>
                                <div class="btn-group">
                                    @can('order.view')
                                    <a href="{{route('dashboard.orders.show',$order->id )}}"
                                        class="btn btn-warning ">
                                        <i class="fab fa-elementor"></i>
                                    </a>
                                @endcan
                                    <form action="{{route('dashboard.orders.destroy',$order->id)}}" method="POST">
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
                            <td colspan="9">No order defined</td>
                        </tr>
                    @endforelse
            </tbody>
       </table>
     </div>
   </div>
 </div>
 {{ $orders->withQueryString()->links() }}
@endsection
