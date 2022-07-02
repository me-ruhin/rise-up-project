<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    public $attendance ;


    /**
	 * Frist of all it will check is the request is from logged user or not.
     *
     * Dependcy injected of  Attendance Class
	 *@param Attendance $attendanceObj
	 * @return \Illuminate\Http\Response
	 */
    public  function __construct(Attendance $attendanceObj)
    {
       $this->middleware('auth');

       $this->attendance = $attendanceObj;


    }

    /**
	 * It will return monthy attendence reports, who is loggedIn.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
    public function getAttendanceReports(){

        $reports =  $this->attendance->getReports();
        return view('member.attendance',compact('reports'));
    }


    /**
	 * It will return specefic monthy attendence reports, who is loggedIn.
	 *
     * @param  Request $request
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
    public function getAttendanceReportsByDate(Request $request){
        $date    = $request->date??date('Y-m-d');
        $reports =  $this->attendance->getReportsByDate( $date);
        return view('member.attendance',compact('reports'));
    }


    /**
	 * store a new attendence report in the database or update if already present
	 *
     * @param  Request $request
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
    public function storeAttendenceReport(Request $request){

      $hasDataCreated = $this->attendance->insertOrUpdateReport($request->all());

        if($hasDataCreated === true){

            return redirect()->route('member.reports')->with('success',$this->attendance->error['message']);
        }
         return back()->with('error',$this->attendance->error['message']);

    }
}
