<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;
use App\Models\enquiry;
use App\Models\agency\joinHelper;
use App\Models\skills;
use App\Models\availability;
use App\Models\country;
use App\Models\employer\viewCount;
use App\Models\employer\reviewInvitation;
use App\Models\reviewReport;



class webController extends Controller
{
    
    function index(){
    	
		return view('web.index');
    }

    function helpers(){
    	$favors = array();
        if(Auth::check()){
            foreach(Auth::user()->favorite as $val){
                array_push($favors, $val->favor_id);
            }
        }
        $filter = array();
        $filter['skills'] = skills::all();
        $filter['expertise'] = skills::whereIn('id', ['1','3','15','13'])->get();
        $filter['availability'] = availability::all();
        $filter['countries'] = country::whereHas('helperUsers', function($qq){
                                $qq->where('country', '!=', null);
                            })->get();
        $helpers = User::where(['status' => '1', 'type' => '2'])->where('id', '!=', Auth::id())->where('fname', '!=', null)->paginate(16);
		return view('web.helpers', ['helpers' => $helpers, 'favors' => $favors, 'filter' => $filter]);
    }

    function helpersCat($cat){
        $favors = array();
        if(Auth::check()){
            foreach(Auth::user()->favorite as $val){
                array_push($favors, $val->favor_id);
            }
        }
        $filter = array();
        $filter['skills'] = skills::all();
        $filter['availability'] = availability::all();
        $filter['countries'] = country::whereHas('users', function($qq){
                                $qq->where('country', '!=', null);
                            })->get();

        $helpers = User::where(['status' => '1', 'type' => '2'])
                        ->where('id', '!=', Auth::id())
                        ->where('fname', '!=', null)
                        ->whereHas('skills', function($q) use ($cat){
                            $q->whereHas('skills', function($qq) use ($cat){
                                $qq->where('skill', $cat);
                            });
                        })
                        ->paginate(16);

        return view('web.helpers', ['helpers' => $helpers, 'favors' => $favors, 'filter' => $filter]);
    }

    function helperSearch(Request $request){
        $data = $request->all();
        $favors = array();
        if(Auth::check()){
            foreach(Auth::user()->favorite as $val){
                array_push($favors, $val->favor_id);
            }
        }

        $helpers = User::where(['status' => '1', 'type' => '2'])
                        ->where('fname', '!=', null)
                        ->when(!empty($data['eavailability']), function ($q) use ($data) {
                            return $q->where('availibility_status', $data['eavailability']);
                        })
                        ->when(!empty($data['eexpertise']), function ($q) use ($data) {
                            return $q->whereHas('expertise', function($q) use ($data){
                                        $q->where('skill_id', $data['eexpertise']);
                                    });
                        })
                        ->when(!empty($data['eskills']), function ($q) use ($data) {
                            return $q->whereHas('skills', function($q) use ($data){
                                        $q->where('skill_id', $data['eskills']);
                                    });
                        })
                        ->when(!empty($data['elocation']), function ($q) use ($data) {
                            return $q->whereHas('details', function($q) use ($data){
                                        $q->where('country', $data['elocation']);
                                    });
                        })
                        ->where('id', '!=', Auth::id())
                        ->paginate(16);
        return view('web.response.helperFilter', ['helpers' => $helpers, 'favors' => $favors]);
    }

    function agencySearch(Request $request){
        $data = $request->all();
        $favors = array();
        if(Auth::check()){
            foreach(Auth::user()->favorite as $val){
                array_push($favors, $val->favor_id);
            }
        }

        $agencies = User::where(['status' => '1', 'type' => '3'])
                        ->where('company', '!=', null)
                        ->when(!empty($data['elocation']), function ($q) use ($data) {
                            return $q->whereHas('details', function($q) use ($data){
                                        $q->where('country', $data['elocation']);
                                    });
                        })
                        ->where('id', '!=', Auth::id())
                        ->paginate(16);
        return view('web.response.agencyFilter', ['agencies' => $agencies, 'favors' => $favors]);
    }
    

    function helperDetail($id, $name){
        if(Auth::check()){
            $eligible = false;
            if(empty(Auth::user()->premium)){
                if(Auth::user()->type == '3' || Auth::user()->type == '2'){
                    $eligible = true;
                }else{
                    $vc = count(Auth::user()->viewCount);
                    if($vc < 5){
                        $eligible = true;
                        viewCount::addCount(base64_decode($id));
                    }
                }
                
            }else{
                $eligible = true;
            }
            if($eligible){
                $favors = array();
                foreach(Auth::user()->favorite as $val){
                    array_push($favors, $val->favor_id);
                }

                $id = base64_decode($id);
                $data = User::where(['status' => '1', 'id' => $id])->first();
                return view('web.helper_profile', ['data' => $data, 'favors' => $favors]);
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }
    

    function employerDetail($id, $name){

        $id = base64_decode($id);
        $data = User::where(['status' => '1', 'id' => $id])->first();
        $invite = reviewInvitation::where(['request_to' => $id, 'request_by' => Auth::id()])->first();
        return view('web.employer_profile', ['data' => $data, 'invite' => $invite]);
    }

    function agencies(){
    	
        $favors = array();
        if(Auth::check()){
            foreach(Auth::user()->favorite as $val){
                array_push($favors, $val->favor_id);
            }
        }
        $countries = country::whereHas('agencyUsers', function($qq){
                        $qq->where('country', '!=', null);
                    })->get();

        $agencies = User::where(['status' => '1', 'type' => '3'])->where('company', '!=', null)->where('id', '!=', Auth::id())->paginate(16);

		return view('web.agencies', ['agencies' => $agencies, 'favors' => $favors, 'countries' => $countries]);
    }

    function agencyDetail($id, $name){
        if(Auth::check()){
            $eligible = false;
            if(empty(Auth::user()->premium)){
                if(Auth::user()->type == '3' || Auth::user()->type == '2'){
                    $eligible = true;
                }else{
                    $vc = count(Auth::user()->viewCount);
                    if($vc < 5){
                        $eligible = true;
                        viewCount::addCount(base64_decode($id));
                    }
                }
                
            }else{
                $eligible = true;
            }
            if($eligible){
                $favors = array();
                foreach(Auth::user()->favorite as $val){
                    array_push($favors, $val->favor_id);
                }
                $id = base64_decode($id);
                $data = User::where(['status' => '1', 'id' => $id])->first();

                $curr_helper = joinHelper::where('agency_id', $id)
                                            ->where('status', '2')
                                            ->where('star', null)
                                            ->orderBy('created_at', 'desc')
                                            ->get();
                    $star_helper = joinHelper::where('agency_id', $id)
                                            ->where('status', '2')
                                            ->where('star', '1')
                                            ->orderBy('created_at', 'desc')
                                            ->get();
                                            
                return view('web.agency_profile', ['data' => $data, 'curr_helper' => $curr_helper, 'star_helper' => $star_helper, 'favors' => $favors]);
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }


    function searchResult(){
        $query = $_GET['query'];

        $databelt = User::orWhere([
                        ['status', '1'],
                        ['type', '2'],
                        ['fname', 'LIKE', '%'.$query.'%']
                    ])->orWhere([
                        ['status', '1'],
                        ['type', '2'],
                        ['lname', 'LIKE', '%'.$query.'%']
                    ])->orWhere([
                        ['status', '1'],
                        ['type', '1'],
                        ['fname', 'LIKE', '%'.$query.'%']
                    ])->orWhere([
                        ['status', '1'],
                        ['type', '1'],
                        ['lname', 'LIKE', '%'.$query.'%']
                    ])->orWhere([
                        ['status', '1'],
                        ['type', '3'],
                        ['company', 'LIKE', '%'.$query.'%']
                    ])
                    ->where('id', '!=', Auth::id())
                    ->paginate(16);
        return view('web.search_result', ['databelt' => $databelt]);
    }

    function sendEnquiry(Request $request){
        $data = $request->all();

        $id = enquiry::addEnquiry($data);

        return $id;
    }



    //Account Settings
    function settings(){
        if(Auth::check()){

            return view('web.settings');
        }else{
            return redirect('/');
        }
    }

    function changePassword(Request $request){
        if(Auth::check()){
            $data = $request->all();
            if($data['new_password'] == $data['confirmation_password']){
                $user = User::find(Auth::id());
                if(Hash::check($data['old_password'], $user->password)) {
                    $user->password = bcrypt($data['new_password']);
                    $user->save();

                    return redirect()->back()->with('success', 'Password updated.');
                } else {
                    return redirect()->back()->with('error', 'Old password is incorrect.');
                }
            } else {
                return redirect()->back()->with('error', 'New password does not match.');
            }
        }else{
            return redirect('/');
        }
    }

    function privateAccount($id){
        if(Auth::check()){
            $user = User::find(Auth::id());
            if($id == '1'){
                $user->private_account = '1';
            }else{
                $user->private_account = null;
            }
            $user->save();

            return 'done';
        }else{
            return redirect('/');
        }
    }

    function deleteAccount(){
        if(Auth::check()){
            $user = User::find(Auth::id());
            $user->status = '5';
            $user->save();

            Auth::logout();

            return redirect('/')->with('success', 'Account Deleted.');
        }else{
            return redirect('/');
        }
    }


    function sendInvitation($id){

        reviewInvitation::addRequest($id);

        return redirect()->back();
    }

    function reportReview($id){
        $id = base64_decode($id);

        reviewReport::addReport($id);

        return redirect()->back()->with('success', 'Review Reported.');
    } 
}
