<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Offer;
use App\Models\Shipment;
use App\Models\User;
use DB;

class ReportsController extends Controller
{
    public function index()
    {
        $reports = Report::with('user','offer')->orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.reports.index', compact('reports'));
    }

    public function create()
    {

    }
  
  
  
    public function show( $id)
    {
        $report = Report::with('user','offer')->first();
        return view('admin.reports.show', compact('report'));

    }
    public function store(ReportRequest $request)
    {
    }

    public function edit($id)
    {
    }


    public function update($id, ReportRequest  $request)
    {
   
    }


    public function destroy($id)
    {
        try {
            $report = Report::find($id);
            if (!$report)
                return redirect()->route('admin.reports')->with(['error' => 'This report doesnt exist']);

            $report->delete();
            return redirect()->route('admin.reports')->with(['success' => 'Report deleted successfuly']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.reports')->with(['error' => 'There is an error please try again']);
        }
    }
 

}
