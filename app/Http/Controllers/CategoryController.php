<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('id')->paginate($request->get('itemsPerPage', 10));

        return inertia('Categories/Index', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $request->validated();

        DB::beginTransaction();

        try {
            $category = new Category();
            $category->name = $request->name;

            $category->save();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->withErrors($exception->getMessage());
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $request->validated();

        DB::beginTransaction();

        try {
            $category->name = $request->name;
            $category->save();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            return back()->withErrors($exception->getMessage());
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        DB::beginTransaction();

        try {
            $category->delete();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            return back()->withErrors($exception->getMessage());
        }
        return back();
    }
}
