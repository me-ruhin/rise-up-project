<?php

namespace App\Models;

use Attribute;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Attendance extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'in_time', 'out_time','in_notation','out_notation'
    ];

    public $type = '';

    public $error = [];

    public function getReports(){
        $userId = Auth::user()->id;
        return Attendance::whereMonth('created_at',Carbon::now()->month)->where('user_id',$userId)->get();
    }
    public function getReportsByDate($date){
        $userId = Auth::user()->id;
        return Attendance::whereDate('created_at','=' ,$date)->where('user_id',$userId)->get();
    }


    public function insertOrUpdateReport($data){
        try{
        DB::beginTransaction();

        $hasReportExits = $this->hasAlreadyAttendanceTaken();
        if( $hasReportExits){
            $hasReportExits->out_time = Carbon::now();
            $hasReportExits->out_notation =$data['notation'];
            $hasReportExits->save();
            $this->error['message'] = 'Attendance successfully updated';
            DB::commit();
            return true;

        }

        $attendanceReport           = new Attendance();
        $attendanceReport->user_id  = Auth::user()->id;
        $attendanceReport->in_time  = Carbon::now();
        $attendanceReport->in_notation  = $data['notation'];
        $attendanceReport->save();
        $this->error['message'] = 'Attendance successfully taken';
        DB::commit();
        return true;
    }catch(Exception $e){
        DB::rollback();
        $this->error['message'] = $e->getMessage();
        $this->error['code'] = $e->getCode();
        return false;

    }




    }

    public function hasAlreadyAttendanceTaken(){

        $userId = Auth::user()->id;
        return Attendance::whereDate('created_at',Carbon::today())->where('user_id',$userId)->first();

    }

}
