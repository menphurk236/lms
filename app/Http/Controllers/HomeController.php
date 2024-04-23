<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Video;
use App\Models\EmployeeVideo;
use DB;
use Log;

class HomeController extends Controller
{
    public function result(Request $request)
    {
        DB::beginTransaction();
        try{
            $employee = Employee::with('department', 'mappingvideo')->where('name', 'LIKE', "%{$request->q}%")->firstOrFail();
            $video = Video::with('categoryvideo')->whereHas('mappingvideo', function ($q) use($employee) {
                        $q->where('employee_id', $employee->id);
            })->withTrashed()->get();
            $resultVideo = EmployeeVideo::with('video')->where('employee_id', $employee->id)->withTrashed()->get();

            $data = [
                'employee' => $employee,
                'video' => $video,
                'resultVideo' => $resultVideo
            ];
            return response()->json($data, 200);
        }catch(\Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function stream(Request $request, $id)
    {
        // getFileDetails() is a custom method to get our video file!
        $details = $this->getFileDetails($id);
        $header = [
            'Cache-Control', 'no-cache, must-revalidate'
        ];
        return response()->file(public_path('storage/' . $details['video_path']), $header);
    }

    public function getFileDetails($id)
    {
        // Get the video file details from the database
        return Video::find($id);
    }

    public function updateVideoStream(Request $request, $id){
        //Log::info("message: ".$request->input('timespent')." id: ".$id." empId: ".$request->input('empId'));
        $updateTime = EmployeeVideo::where('video_id', $id)->first();
        if($updateTime != null){
            $updateTime->timespent = $request->input('timespent');
            $updateTime->employee_id = $request->input('empId');
            $updateTime->video_id = $id;
            $updateTime->save();
            // return response()->json(['message' => 'Video time updated successfully'], 200);
        }else{
            $newTime = new EmployeeVideo();
            $newTime->video_id = $id;
            $newTime->timespent = $request->input('timespent');
            $newTime->employee_id = $request->input('empId');
            $newTime->save();
        }
    }
}
