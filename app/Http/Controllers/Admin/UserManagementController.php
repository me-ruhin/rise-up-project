<?php

namespace App\Http\Controllers\Admin;

use App\Helper\ImageUploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Http\Requests\MemberUpdateRequest;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public $user;
    use ImageUploader;


    public function __construct(User $userObj)
    {
        $this->user = $userObj;

    }

     /**
     * It will show all the member list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function getMemberList(){
        $date = $this->sanitizeMonthAndYear(request()->month);

        // $month = Carbon::createFromDate(request()->month);
          $users = $this->user->getUserList($date);
        return view('admin.members',compact('users'));
    }


    public function sanitizeMonthAndYear($month = ''){
        $dateArray = [];
        if($month){
          $data               =   explode("-",$month);
          $dateArray['month'] =   $data[1];
          $dateArray['year']  =   $data[0];
          return $dateArray;
        }
        $dateArray['month'] =   date('m');
        $dateArray['year']  =   date('Y');
        return $dateArray;

    }


    public function addMember(MemberRequest $request){


        $imageName  =  $this->storeImage($request->file('image'));

       $hasUserCreated =  $this->user->storeUser($request->all(),$imageName);

       if($hasUserCreated === true){

           return back()->with('success','Member successfully added !');
       }
        return back()->with('error',$this->user->error['message']);


    }
    public function updateMember(MemberUpdateRequest $request,User $user){
        $imageName = "" ;

        if($request->file('image')){

            $imageName  =  $this->storeImage($request->file('image'));
        }

       $hasUserCreated =  $this->user->updateUser($request->all(),$imageName,$user);

       if($hasUserCreated === true){

           return back()->with('success','Member successfully updated !');
       }
        return back()->with('error',$this->user->error['message']);


    }





    public function deleteMember(User $user){

        if($this->user->deleteMember($user)){
            return back()->with('success','Member successfully Deleted !');
        }
        return back()->with('error',$this->user->error['message']);

    }
}
