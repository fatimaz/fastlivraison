<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Report;
use DB;
use Validator;

class ReportController extends Controller
{
    use GeneralTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth:api', ['except' => ['show']]);
    }
        // $this->middleware('CheckUserToken:api');
        // $this->middleware('auth.guard:api'); 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $validator = Validator::make($request->all(),[              
                    "sujet" =>"required",
                    "message" =>"required|string|max:2000"
                ]);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

             
            $report = new Report();
            if (!$request->has('is_active'))
                 $report->is_active = 0; 
             else
                 $report->is_active = 1; 
            
             $report->user_id = auth('api')->user()->id;
             $report->order_id = $request->input('order_id');  
             $report->sujet =  $request->input('sujet');  
             $report->message = $request->input('message');  
           
             $report->save();
             DB::commit();
             return $this->returnSuccessMessage('Report sent successfully');
            } catch (\Exception $ex) {
                     DB::rollback();
                    return $this->returnError($ex->getCode(), $ex->getMessage());
            }
        }

    public function show($id){ 
    }

    public function update(Request $request,$id)
    {}
}