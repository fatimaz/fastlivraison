<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
Use Redirect;
use DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingsRequest;
use App\Models\Setting;
use App\Models\SiteSetting;

class SettingsController extends Controller
{
    public function editShippingMethods($type)
    {

       //free , inner , outer for shipping methods

        if ($type === 'free')
            $shippingMethod = Setting::where('key', 'free_shipping_label')->first();


        elseif ($type === 'inner')
            $shippingMethod = Setting::where('key', 'local_label')->first();

        elseif ($type === 'outer')
            $shippingMethod = Setting::where('key', 'outer_label')->first();
        else
            $shippingMethod = Setting::where('key', 'free_shipping_label')->first();

        return view('admin.settings.shippings.edit', compact('shippingMethod'));

    }


    public function updateShippingMethods(ShippingsRequest $request, $id)
    {
        //update db

        try {
            $shipping_method = Setting::find($id);

            DB::beginTransaction();
            $shipping_method->update(['plain_value' => $request->plain_value]);
            //save translations
            $shipping_method->value = $request->value;
            $shipping_method->save();

            DB::commit();
            return redirect()->back()->with(['success' => 'saved successfuly']);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'Error, please try again']);
            DB::rollback();
        }

    }




}

//    public function index(SiteSetting $siteSetting){
//        $siteSetting = $siteSetting->all();
//        return view('admin.sitesetting.index', compact('siteSetting'));
//    }
//    //
//    public function store(Request $request ,SiteSetting $siteSetting){
//
//        foreach(array_except($request->toArray(), ['_token','submit']) as $key =>$req){
//
//            $siteSettingUpdate= $siteSetting-> where('namesetting', $key)->get()[0];
//            if($siteSettingUpdate->type !=3){
//                $siteSettingUpdate->fill(array('value'=>$req))->save();
//            }else{
//                $extention = $req->getClientOriginalExtension();
//                $newFileName = str_random(13) . '.' . $extention;
//                $fileName= uploadImage($req, $newFileName,'/public/website/slider/','1600','500', $siteSettingUpdate->value);
//                if($fileName){
//                    $siteSettingUpdate->fill(array('value'=>$fileName))->save();
//                }
//            }
//
//        }
//        return redirect::back()->withFlashMessage('setting is updated successfuly');
//    }
//}
