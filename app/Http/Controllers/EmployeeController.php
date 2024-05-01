<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\MappingVideo;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
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
            $employees = Employee::with('department', 'employeeVideos')->whereNull('deleted_at')->where(function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->q}%")
                ->orWhere('code', 'like', "%{$request->q}%");
            })->latest()->get();
            DB::commit();
            return response()->json($employees, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to retrieve employees', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $employee = new Employee();
            $employee->code = $request->code;
            $employee->name = $request->name;
            $employee->department_id = $request->department_id;
            $employee->save();
            DB::commit();
            return response()->json(['message' => 'Employee created successfully'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to create employee', 'error' => $e->getMessage()], 500);
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
            $employee = Employee::with('department')->find($id);
            $employeeVideos = MappingVideo::with('video')->where('employee_id', $id)->get();
            $employee->employeeVideos = $employeeVideos;
            DB::commit();
            return response()->json($employee, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to retrieve employee', 'error' => $e->getMessage()], 500);
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
        //
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
            $employee = Employee::find($id);
            $employee->code = $request->code;
            $employee->name = $request->name;
            $employee->department_id = $request->department_id;
            $employee->save();
            DB::commit();
            return response()->json($employee, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to update employee', 'error' => $e->getMessage()], 500);
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
            Employee::destroy($id);
            DB::commit();
            return response()->json(['message' => 'Employee deleted successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to delete employee', 'error' => $e->getMessage()], 500);
        }
    }

    public function AddEmployeeVideos($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $findDepartment = Employee::find($id);
            MappingVideo::create([
                'employee_id' => $id,
                'video_id' => $request->video_id,
                'department_id' => $findDepartment['department_id'],
                'created_at' => now()
            ]);

            DB::commit();
            return response()->json(['message' => 'add video employee'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to retrieve employee videos', 'error' => $e->getMessage()], 500);
        }
    }

    public function RemoveEmployeeVideos($id)
    {
        DB::beginTransaction();
        try {
            MappingVideo::where('id', $id)->delete();
            DB::commit();
            return response()->json(['message' => 'remove video employee'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to retrieve employee videos', 'error' => $e->getMessage()], 500);
        }
    }
}
