<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\User;
use App\Traits\GeneralTrait;
use Validator;
use DB;

class CartsController extends Controller
{
     use GeneralTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      try {
        $findcart = Cart::where('user_id',99)->first();
        if(!$findcart){
          $cart = Cart::create(['user_id' => 99,
          'total'=>0]);
        }
        
        $carts = Cart::with('products','cartproduct')->where('user_id',93)->first();
          return $this-> returnData('carts',$carts);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function store(Request $request)
    {
       try {
       $cart_product = new CartProduct();

      //  $cart_id = Cart::where('user_id',80)->first();

      //   $CartItem = CartItem::where('item_id',$request->input('menu_id'))->first();
      //   $taskId = $request->input('options_ids');

        // if($CartItem){
        // $completedCourses =  $CartItem->options()->pluck('option_id')->toArray();
        // $result = array_intersect($completedCourses, $taskId);
        // $sortedArr = collect($result)->sort()->values();
        // $sortedtask = collect($taskId)->sort()->values();
     
        //   if($sortedArr ==  $sortedtask) {
        //     $CartItem->count = $CartItem->count + $request->input('count');  
        //     $CartItem->cost = $CartItem->cost + $request->input('cost');  
        //      $CartItem->save();
        //    return $this->returnSuccessMessage('cart updated successfully');
        //   }
        // }

         $cart_product->cart_id =  $request->input('cart_id');
         $cart_product->product_id = $request->input('product_id');    
         $cart_product->count =$request->input('count');  
         $cart_product->cost = $request->input('cost');  
         $cart_product->inCart =1; 

         $cart_product->save();
        //  $cart_total = $cart_product->select('cost')->where('cart_id',1)->get();

        //  $cart_total=(int)$cart_tot;
        //  return  $cart_total;
        //  $totalcost =  $cart_total + $request->input('cost');
        //  return  $totalcost;

        //  if(  $cart_item->count >1){
        //   $total = 0;
        //   $carts = CartItem::where('cart_id',$cart_item->cart_id)->get(); 
        //     foreach($carts as $cart){
        //       $total += $cart->cost  ;
        //     }
        //     $cart = Cart::where('id',$cart_item->cart_id)->first();
        //     $cart ->total = $total;
        //     $cart-> save();
        // }
  
        //  $cart_item->options()->attach($request->input('options_ids'));

         return $this->returnSuccessMessage('cart saved successfully');
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {}
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
    public function update($id, Request $request)
    {
      try {
        DB::beginTransaction();

        $cartitem = CartProduct::find($id);

          if (!$cartitem)
             return $this->returnError('no product available');

          $cartitem->count = $request->input('count');
          $cartitem->save();
      
          if( $cartitem->count >1){
            // $total = 0;
            // $cart = Cart::where('id',$cartitem->cart_id)->first(); 
              // foreach($cart->items as $product){
                 $cartitem->cost = $cartitem->cost *  $request->input('count');
                 $cartitem->save();
                // $total += $product->price* $product->pivot->qty ;
              // }
              // $cart ->total = $total;
              // $cart-> save();
          }
          DB::commit();
        return $this->returnSuccessMessage('Cart updated successfully');
      } catch (\Exception $ex) {
         DB::rollback();
        return $this->returnError($ex->getCode(), $ex->getMessage());
      }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {}

}







