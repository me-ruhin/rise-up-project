<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    public $attendance ;

    public  function __construct(Attendance $attendanceObj)
    {
       $this->attendance = $attendanceObj;

    }

    public function getAttendanceReports(){

        $reports =  $this->attendance->getReports();
        return view('member.attendance',compact('reports'));
    }

    public function getAttendanceReportsByDate(Request $request){
        $date = $request->date??date('Y-m-d');
        $reports =  $this->attendance->getReportsByDate( $date);
        return view('member.attendance',compact('reports'));
    }



    public function storeAttendenceReport(Request $request){

      $hasDataCreated = $this->attendance->insertOrUpdateReport($request->all());

        if($hasDataCreated === true){

            return redirect()->route('member.reports')->with('success',$this->attendance->error['message']);
        }
         return back()->with('error',$this->attendance->error['message']);

    }
}
