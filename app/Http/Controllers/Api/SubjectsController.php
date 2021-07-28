<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\SubjectsTutors;
use App\Subject;
use App\Tutor;
class SubjectsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
          // $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::orderBy('created_at', 'DESC')->get();
        return response()->json([
            'success' => true,
            'message' => 'subjects',
            'subjects' => $subjects
        ]);
    }

    public function show($id)
    {
        //  $tutors= Subject::find($id)->tutors->where('status',1);
        $subject = SubjectsTutors::where('subject_id',$id)->pluck('tutor_id');
        $tutors = Tutor::whereIn('id', $subject)
            ->where('status',1)
            ->with('subjects','certificates','city','levels')
            ->orderBy('created_at','ASC')
            ->get();

        return response()->json([
            'success' => true,
            'message'=> 'tutors list',
            'tutors' => $tutors
        ]);
    }
}