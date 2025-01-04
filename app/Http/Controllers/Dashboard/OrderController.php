<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('order.view');
        $request= request();
        $user = Auth::user();
        // if($user === Schema::hasTable('admins'))
        // {
        //    $orders = Order::all();
        // }else{
            $orders = Order::where('user_id','=',$user->id)
                        ->with(['products','user','addresses'])
                        ->filter($request->query())
                        ->paginate(5);
        // }

       return view('dashboard.orders.index',compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('order.view');
        $request= request();
        $order = Order::findOrFail($id)
                ->with(['products','user','addresses'])
                ->filter($request->query());
        $orderItem = OrderItem::where('order_id','=',$order)
                    ->with(['product','order']);
        return view('dashboard.orders.show',
        [
            'order'=>$order,
            'orderItem'=>$orderItem
        ]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('order.delete');
        
        $order =Order::findOrFail($id);
        $order->delete();
        $seved= $order;
        if($seved){
            session()->flash('success','order delete scssesfuly');
            return redirect()->route('dashboard.orders.index');
        }
    }

    public function trash(){
        Gate::authorize('order.view');
        $orders=Order::onlyTrashed()->paginate();
        return view('dashboard.orders.trash',compact('orders'));
    }
    public function restore(Request $request,$id)
    {
        Gate::authorize('order.view');
        $order=Order::onlyTrashed()->findOrFail($id);
        $order->restore();
        return redirect()->route('dashboard.orders.trash')
        ->with('success','order restoreed! ');
    }
    public function forceDelete($id)
    {
        Gate::authorize('order.view');
        $order=Order::onlyTrashed()->findOrFail($id);
        $order->forceDelete();
        return redirect()->route('dashboard.orders.trash')
        ->with('success','order delete scssesfuly!');
    }
}
