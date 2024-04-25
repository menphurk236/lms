<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\VideoCategory;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\MappingVideo;
use Illuminate\Support\Facades\Log;
use App\Models\Department;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        DB::beginTransaction();
        try {
            $videos = Video::with('user', 'categoryvideo')->whereNull('deleted_at')->where(function ($query) use ($request) {
                $query->where('title', 'like', "%{$request->q}%");
            })->latest()->get();
            DB::commit();
            return response()->json($videos, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to retrieve videos', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = VideoCategory::all();

        $data = [
            'category' => $category
        ];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            /* Storing the file on the disk  */
            $extension = $request->file('video_path')->getClientOriginalExtension();
            $fileName = Str::random(5)."-".date('his')."-".Str::random(3).".".$extension;
            $id = Video::create([
            'category_video_id' => $request->category_video_id,
            'title' => $request->title,
            'video_path' => $request->file('video_path')->storeAs(
                'video',
                $fileName,
                'public'
            ),
            'video_duration' => $request->video_duration,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
            'created_upload' => $request->created_upload
        ])->id;

        if($request->employee_id != null){
            foreach ($request->employee_id as $key) {
                $value = trim($key);
                if ($value !== '') {
                    $employee = Employee::where('id', $key)->firstOrFail();
                    $mapVideoReq = [
                        'video_id' => $id,
                        'employee_id' => $value,
                        'department_id' => $employee['department_id']
                    ];
                    MappingVideo::insert($mapVideoReq);
                }
            }
        }
            DB::commit();
            return response()->json('create video successfully', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to create video', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        DB::beginTransaction();
        try {
            $video = Video::find($id);
            $video->department_id = Department::whereHas('mappingvideo', function($q) use ($id){
                    $q->where('video_id', $id);
                })->get();
            $video->employee_id = Employee::whereHas('mappingvideo', function($q) use ($id){
                    $q->where('video_id', $id);
                })->get();
            DB::commit();
            return response()->json($video, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to retrieve video', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        DB::beginTransaction();
        try {
            $video = Video::find($id);
            $videoCategories = VideoCategory::all();
            DB::commit();
            return response()->json(['video' => $video, 'videoCategories' => $videoCategories], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to retrieve video', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $video = Video::find($id);
            $video->category_video_id = $request->category_video_id != null ? $request->category_video_id : $video->category_video_id;
            $video->title = $request->title != null ? $request->title : $video->title;
            $video->video_duration = $request->video_duration != null ? $request->video_duration : $video->video_duration;
            $video->video_path= $request->video_path != null ? $request->file('video_path')->storeAs('video',$request->file('video_path')->getClientOriginalName() . '.' . $request->file('video_path')->getClientOriginalExtension()) : $video->video_path;
            $video->updated_by = auth()->user()->id;
            $video->created_upload = $request->created_upload != null ? $request->created_upload : $video->created_upload;
            $video->updated_at = now();
            $video->save();

            $mappingVideo = MappingVideo::where('video_id', $id)->firstOrFail();
            if($mappingVideo != null){
                $mappingVideo->employee_id = $request->employee_id != null ? $request->employee_id : $mappingVideo->employee_id;
                $mappingVideo->department_id = $request->employee_id != null ? $request->employee_id : $mappingVideo->department_id;
                $mappingVideo->save();
            }else{
                if($request->employee_id != null){
                    foreach ($request->employee_id as $key) {
                        $value = trim($key);
                        if ($value !== '') {
                            $employee = Employee::where('id', $key)->firstOrFail();
                            $mapVideoReq = [
                                'video_id' => $id,
                                'employee_id' => $value,
                                'department_id' => $employee['department_id']
                            ];
                            MappingVideo::insert($mapVideoReq);
                        }
                    }
                }
            }
            DB::commit();
            return response()->json($video, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::alert($e->getMessage());
            return response()->json(['message' => 'Failed to update video', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $video = Video::find($id);
            $video->delete();
            DB::commit();
            return response()->json($video, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to delete video', 'error' => $e->getMessage()], 500);
        }
    }
}
