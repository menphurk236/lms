<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryVideo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        DB::beginTransaction();
        try {
            $categories = CategoryVideo::whereNull('deleted_at')->get();
            DB::commit();
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to retrieve categories', 'error' => $e->getMessage()], 500);
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
            $category = new CategoryVideo();
            $category->code = $request->code;
            $category->name = $request->name;
            $category->created_by = auth()->user()->id;
            $category->updated_by = auth()->user()->id;
            $category->save();
            DB::commit();
            return response()->json($category, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to create category', 'error' => $e->getMessage()], 500);
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
            $category = CategoryVideo::find($id);
            DB::commit();
            return response()->json($category, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to retrieve category', 'error' => $e->getMessage()], 500);
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
            $category = CategoryVideo::find($id);
            DB::commit();
            return response()->json($category, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to retrieve category', 'error' => $e->getMessage()], 500);
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
            Log::alert("message", $request->all());
            $category = CategoryVideo::find($id);
            $category->code = $request->get('code') ?? $category->code;
            $category->name = $request->get('name') ?? $category->name;
            $category->updated_by = auth()->user()->id;
            $category->save();
            DB::commit();
            return response()->json($category, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to update category', 'error' => $e->getMessage()], 500);
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
            $categoryVideo = CategoryVideo::find($id);
            $categoryVideo->delete();
            DB::commit();
            return response()->json(['message' => 'Category deleted successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to delete category', 'error' => $e->getMessage()], 500);
        }
    }
}
