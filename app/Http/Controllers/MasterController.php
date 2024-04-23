<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\CategoryVideo;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
    public function CategoryVideo()
    {
        DB::beginTransaction();
        try {
            $category = CategoryVideo::withTrashed()->get();
            DB::commit();
            return response()->json($category, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to retrieve category video', 'error' => $e->getMessage()], 500);
        }
    }

    public function Department()
    {
        DB::beginTransaction();
        try {
            $department = Department::withTrashed()->get();
            DB::commit();
            return response()->json($department, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to retrieve department', 'error' => $e->getMessage()], 500);
        }
    }

    public function Employee()
    {
        DB::beginTransaction();
        try {
            $employee = Employee::withTrashed()->get();
            DB::commit();
            return response()->json($employee, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to retrieve employee', 'error' => $e->getMessage()], 500);
        }
    }

    public function EmployeeByDepartment(Request $request)
    {
        DB::beginTransaction();
        try {
            $search = explode(',', $request->input('search'));
            $employee = Employee::whereIn('department_id', $search)->withTrashed()->get();
            DB::commit();
            return response()->json($employee, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to retrieve employee', 'error' => $e->getMessage()], 500);
        }
    }

    public function Video()
    {
        DB::beginTransaction();
        try {
            $video = Video::withTrashed()->get();
            DB::commit();
            return response()->json($video, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to retrieve video', 'error' => $e->getMessage()], 500);
        }
    }
}
