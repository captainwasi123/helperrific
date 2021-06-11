<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reviewReport;
use App\Models\orders\reviews;
use Auth;

class reviewReportController extends Controller
{
    //
    function index(){
        if(Auth::guard('admin')->check()){

            $data = reviewReport::orderBy('id', 'desc')->simplePaginate(25);

            return view('admin.reports.list', ['databelt' => $data]);
        }else{
            return redirect('admin\login');
        }
    }

    function hide($id){
        if(Auth::guard('admin')->check()){
            $id = base64_decode($id);
            $report = reviewReport::find($id);
            $review = reviews::find($report->review_id);
            $review->status = '0';
            $review->save();

            return redirect()->back()->with('success', 'Review hidden.');
        }else{
            return redirect('admin\login');
        }
    }

    function delete($id){
        if(Auth::guard('admin')->check()){
            $id = base64_decode($id);
            $report = reviewReport::find($id);
            reviews::destroy($report->review_id);
            reviewReport::destroy($id);

            return redirect()->back()->with('success', 'Review Deleted.');
        }else{
            return redirect('admin\login');
        }
    }
}
