<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Video;
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
            })->get();

            $data = [
                'employee' => $employee,
                'video' => $video
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
}
