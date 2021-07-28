<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use DB;

class CouponsController extends Controller
{
  

  public function index(){
      $coupons = Coupon::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
  	return view('admin.coupons.index',compact('coupons'));
  }

  public function store(CouponRequest $request){
//another way of saving
        $coupon = Coupon::create([
          'name' => $request -> name,
          'discount'=> $request -> discount,

          ]);
        return redirect()->back()->with(['success' => 'Coupon added successfully']);
 
  }

    public function edit($id)
    {


        $coupon = Coupon::find($id);

        if (!$coupon)
            return redirect()->route('admin.coupons')->with(['error' => 'This coupon doesnt exist']);

        return view('admin.coupons.edit', compact('coupon'));

    }
 
 public function update($id, CouponRequest  $request)
    {
        try {
            //validation

          
            $coupon = Coupon::find($id);

            if (!$coupon)
                return redirect()->route('admin.coupons')->with(['error' => 'This coupon doesnt exist']);


            DB::beginTransaction();


            $coupon->update([
              'name' => $request -> name,
              'discount'=> $request -> discount,

            ]);  

            DB::commit();
            return redirect()->route('admin.coupons')->with(['success' => 'Coupon updated successfully']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.coupons')->with(['error' => 'There is an error please try again ']);
        }

    }


     public function destroy($id)
    {
        try {
            
            $coupons = Coupon::find($id);

            if (!$coupons)
                return redirect()->route('admin.coupons')->with(['error' => 'This coupon doesnt exist']);

            $coupons->delete();

            return redirect()->route('admin.coupons')->with(['success' => 'coupon deleted successfully']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.coupons')->with(['error' => 'There is an error please try again']);
        }
    }


 
 public function Newsletter(){
 	$sub = DB::table('newsletters')->get();
 	return view('admin.coupons.newsletter',compact('sub'));
 }


  public function DeleteSub($id){
    DB::table('newsletters')->where('id',$id)->delete();
  return redirect()->back()->with(['success' => 'Subscriber deleted successfully']);
  }



}