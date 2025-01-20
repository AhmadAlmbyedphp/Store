<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Psy\Command\ThrowUpCommand;
use Symfony\Component\Intl\Countries;
use Throwable;

class CheckoutController extends Controller
{
    public function create(CartRepository $cart)
    {
        if($cart->get()->count() == 0){
            return redirect()->route('home');
        }
      return view('front.checkout',[
        'cart'=>$cart,
        'countries'=>Countries::getNames(),
      ]);
    }

    public function store(Request $request, CartRepository $cart)
    {
        // Validate the incoming request, leaving it empty for now since validation rules are not provideظd
        $request->validate([
            // 'validation_rule' => 'required|other_rules',
            'addr.billing.first_name'=>['required','string','max::255'],
            'addr.billing.last_name'=>['required','string','max::255'],
            'addr.billing.email'=>['required','string','max::255'],
            'addr.billing.phone_number'=>['required','max::255'],
            'addr.billing.city'=>['required','string','max::255'],
          //  'adde.billing.*'=>['string','max::255'],
        ]);
        // Retrieve items from the cart, grouped by 'store_id' for each product, and convert to array format
        $items = $cart->get()->groupBy('product.store_id')->all();

        // Start a database transaction to ensure all operations succeed or fail together
        DB::beginTransaction();

        try {
            // Loop through each store's items in the cart
            foreach ($items as $store_id => $cart_items) {
                // Create a new order for each store
                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id' => Auth::id(),
                    'payment_method' => 'cod', // 'cod' stands for Cash on Delivery
                ]);

                // Loop through each item in the current store's cart and add it to the order
                foreach ($cart_items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product->id,
                        'product_name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                    ]);
                }

                // Add each address provided in the request under the current order
                foreach ($request->post('addr') as $type => $address) {
                    $address['type'] = $type; // Add address type (e.g., billing, shipping)
                    $order->addresses()->create($address);
                }
            }

            event(new OrderCreated($order));
            // Commit the transaction to finalize the database operations
            DB::commit();

        } catch (Throwable $e) {
            // Roll back the transaction if any error occurs, reverting any changes made
            DB::rollBack();
            throw $e; // Re-throw the exception to handle it further up the call stack
        }

        // Redirect the user to the 'home' route upon success
       // return redirect()->route('home');
       return redirect()->route('orders.payments.create', $order->id);
    }

}
