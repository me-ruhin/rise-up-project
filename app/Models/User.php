<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $error = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function attendences(){
        return $this->hasMany(Attendance::class);
    }

    /**
     * Get the user's role type.
     *
     * @param  integer  $role_id
     * @return string
     */
    public function getRoleTypeAttribute()
    {
        return $this->is_admin == 1 ?'Admin':'Member';
    }


    public function getUserList($date)
    {
         return  $user = User::with(['attendences'=> function($q) use($date){
            $q->whereMonth('in_time',$date['month']);
            $q->whereYear('in_time',$date['year']);
         }])->withCount('attendences')->select('id','is_admin','name','photo',)->latest()->paginate(20);
    }
    public function storeUser($data,$image){
        try{
            DB::beginTransaction();
            $user           = new User;
            $user->name     = $data['name'];
            $user->email    = $data['email'];
            $user->is_admin = $data['role_id'];
            $user->password = bcrypt($data['password']);
            $user->photo    = $image;
            $user->save();
            DB::commit();
            return true;
        }catch(Exception $e){
            DB::rollback();
            $this->error['code']     = $e->getCode();
            $this->error['message']  = $e->getMessage();
            return false;

        }
    }
    public function updateUser($data,$image,$user){
        try{
            DB::beginTransaction();

            if($image){
                $this->hasImageExists($user->photo);
            }

            $user->name     = $data['name'];
            $user->email    = $data['email'];
            $user->is_admin = $data['role_id'];
            $user->password = $data['password']?bcrypt($data['password']):$user->password;
            $user->photo    = $image?$image:$user->photo;
            $user->save();
            DB::commit();
            return true;
        }catch(Exception $e){
            DB::rollback();
            $this->error['code']     = $e->getCode();
            $this->error['message']  = $e->getMessage();
            return false;

        }
    }


    public function deleteMember($user){
        try{
            DB::beginTransaction();

            if($this->isLoggedUser($user->id) === false){
                $this->error['message'] ='You are not permit to delete yourself';

                DB::commit();
                return false;
            }
            if($user){
                $this->hasImageExists($user->photo);
                $user->delete();
                DB::commit();

                return true;

            }else{
                $this->error['message'] ='internal server error';
                DB::rollback();
                return true;
            }

        }catch(Exception $e){
            $this->error['code']     = $e->getCode();
            $this->error['message']  = $e->getMessage();
            return true;

        }



    }

    public function hasUserExists($userId){
        return User::find($userId);
    }

    public function hasImageExists($name){
        if($name){
            $image = public_path('uploads/'.$name);
            if ( file_exists($image) ) {
                unlink($image);
            }
        }
        return true;
    }

    public function isLoggedUser($userId)
    {
        return Auth::user()->id === $userId ?false:true;
    }
}
