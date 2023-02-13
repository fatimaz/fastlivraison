<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use App\Models\CartItemOption;
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
        $carts = Cart::with('items')->withCount('items')->first();
          // $carts = CartItem::with('menu','menu.attributes', 'menu.attributes.options', 'cart')->get();
          return $this-> returnData('carts',$carts);

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function store(Request $request)
    {
       try {

        // $validator = Validator::make($request->all(), [
        //         "from_id" => "required",                 
        //         "to_id" => "required",  
        //         "weight_total" =>"required"
        //     ]);
        //  if ($validator->fails()) {
        //     $code = $this->returnCodeAccordingToInput($validator);
        //     return $this->returnValidationError($code, $validator);
        // }
     
        // $cart = new Cart();
        // $cart->id =2; 
        // $cart->user_id =80; 
        // $cart->save();
       // DB::beginTransaction();


       $cart_item = new CartItem();

        $CartItem = CartItem::where('item_id',$request->input('menu_id'))->first();

        // $hasTask = $CartItem->options()->where('cart_item_id', $request->input('options_ids'))->exists();
        // return $hasTask;
        $taskId = $request->input('options_ids');
        // $ee = CartItemOption::where('cart_item_id',117)->first();
   

      
        $completedCourses =  $CartItem->options()->pluck('option_id')->toArray();
        //  CartItemOption::where('cart_item_id',117)->pluck('option_id')->toArray();
        
        $result = array_intersect($completedCourses, $taskId);
        $sortedArr = collect($result)->sort()->values();
        $sortedtask = collect($taskId)->sort()->values();
          if($sortedArr ==  $sortedtask) {
              return 1;
          }else{
            return 2;
          }
        // foreach($taskId as $id){
        //     $ee->where('option_id',$id);
        // }
        // if($ee->exists()){
        //   return '1';
        // }else{
        //   return '2';
        // }

        // 

        // $ee = CartItemOption::where('option_id', $taskId)->count();
    
if($CartItem->options()->whereIn('option_id', $taskId)->count()>0){
  $CartItem->count = $CartItem->count + $request->input('count');  
   $CartItem->cost = $CartItem->cost + $request->input('cost');  
    $CartItem->save();
  return $this->returnSuccessMessage('cart updated successfully');
}

        if($CartItem){

        //  $cartItemcount = CartItemOption::where('option_id', $taskId)->exists();
        //  $cartItemcount = CartItemOption::pluck('option_id');
        //  return  $taskId  ;
        //    $cartItemcount->diff($taskId);
        //  return $cartItemcount->isEmpty();
        //  return $cartItemcount ;




        foreach ($taskId as $id) {
            
         $hasPivot = CartItemOption::whereHas('option', function ($q) use ($taskId) {
             $q->where('option_id', $taskId);
          });
     
        }
        $hasPivot->get(); 
    return $hasPivot;


      //  if( $cartItemcount){
      //   $CartItem->count = $CartItem->count + $request->input('count');  
      //   $CartItem->cost = $CartItem->cost + $request->input('cost');  
      //   $CartItem->save();
      //   return $this->returnSuccessMessage('cart updated successfully');
   
      //  }







       // return $hasPivot; 
        // foreach ($taskId as $id) {
          // return $option_id;
          // $skilledEmployees = $CartItem->with('options')->whereHas('options', function ($q) use ($id) {     
          //   $q->where('option_id', $id);
          //    })->get();
          //    return  $skilledEmployees;
        // }
      
        // if($hasPivot){
        //   $CartItem->count = $CartItem->count + $request->input('count');  
        //    $CartItem->cost = $CartItem->cost + $request->input('cost');  
        //    $CartItem->save();
        //    return $this->returnSuccessMessage('cart updated successfully');
      
        // }
      }

        // $hasUser = $CartItem->options()->where('option_id', $taskId)->exists();

        // if( $hasUser){
        //   return 1;
        // }else{
        //   return 2;
        // }

      //   $hasPivot = $CartItem::whereHas('options', function ($q) use ($taskId) {
      //     $q->where('cart_item_id',  $taskId);
      // })
      // ->exists();


        // foreach ($cart_item->options() as $option){
        //   $cartitem =  $option->where('item_id',$request->input('menu_id'))->first();
        // }
         $cart_item->cart_id =  1;  
         $cart_item->item_id = $request->input('menu_id');    
         $cart_item->count =$request->input('count');  
         $cart_item->cost = $request->input('cost');  
         $cart_item->inCart =1; 

         $cart_item->save();
  
         $cart_item->options()->attach($request->input('options_ids'));

       //  DB::commit();
         return $this->returnSuccessMessage('cart saved successfully');
        } catch (\Exception $ex) {
            // DB::rollback();
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

        $cartitem = CartItem::find($id);

          if (!$cartitem)
             return $this->returnError('no product available');

          $cartitem->count = $request->input('count');
      
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







