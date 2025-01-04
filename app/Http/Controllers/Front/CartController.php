<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CartController extends Controller
{

    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Display a listing of the resource.
     *
     *  CartRepository is interface  and ServiceProvider in CartServiceProvider
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $repositoy= new  CartModelRepository();
        return view('front.cart',[
        'cart' => $this->cart,
        ]);


    }
    /**
     * Store a newly created resource in storage.
     *
     * CartRepository is interface  and ServiceProvider in CartServiceProvider
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request,CartRepository $cart)
    {
        $request ->validate([
            'product_id'=>['required','int','exists:products,id'],
            'quantity'=>['nullable','int','min:1'],
        ]);
        $product =Product::findOrfail($request->post('product_id'));
        $cart->add($product, $request->post('quantity'));
         return redirect()->route('cart.index')
          ->with('success','Product added  to cart !');
    }
    /**
     * Update the specified resource in storage.
     *
     * CartRepository is interface  and ServiceProvider in CartServiceProvider
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request,$id)
    {

        $request ->validate([
            'quantity'=>['required','int','min:1'],
        ]);
        // 'product_id'=>['required','int','exists:products,id'],
        //  $product =Product::findOrfaill($request->post('product_id'));
        $this->cart->update($id, $request->post('quantity'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // public function destroy(CartRepository $cart, $id)
    // {
    //     $cart->delete($id);
    // }
    public function destroy( $id)
    {
        $this->cart->delete($id);
        return[
            'message'=>'item deleted!',
        ];
    }

}
