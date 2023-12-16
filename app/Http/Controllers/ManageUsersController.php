<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Position;

class ManageUsersController extends Controller
{
    public function index(Request $Request){
    	$users = User::with('position')->whereNull('deleted_at')->get()->toArray();
    	$positions = Position::all()->toArray();
    	return view('pages.manageUsers',['users'=>$users,'positions'=>$positions]);
    }

    public function update(Request $Request){
    	$result = $Request->all();
		$user = User::find($result['userId']??$result['userIdDelete']);
    	if(!isset($result['userIdDelete'])){
	    	$user->email = $result['email'];
	    	$user->name = $result['name'];
	    	$user->position_id = $result['position'];

	    	if($result['second_password']){
	    		$user->password = Hash::make($result['second_password']);
	    	}
	    	$user->save();
    	}else{
    		$user->softDelete();
    	}

    	return redirect('/users');
    	
    }
}
