<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonRequest;
use App\Models\Category;
use App\Models\Lesson;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
        $lessons = Lesson::select('lessons.*', 'levels.name as level_name')
            ->join('levels', 'lessons.level_id', '=', 'levels.id')
            ->orderBy('lessons.id')->paginate($request->get('itemsPerPage', 10));

        $levels = Level::get();
        $categories = Category::get();
        return inertia("Lessons/Index", [
            "lessons" => $lessons,
            "levels" => $levels,
            "categories" => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LessonRequest $request)
    {
        $request->validated();

        DB::beginTransaction();

        try {
            $lesson = new Lesson();
            $lesson->name = $request->name;
            $lesson->description = $request->description;
            $lesson->level_id = $request->level_id;
            $lesson->is_free = $request->is_free;
            $lesson->save();

            if($request->categories){
                $lesson->categories()->sync($request->categories);
            }

            DB::commit();

        } catch (\Exception $exception) {
            return back()->with("error", $exception->getMessage());
        }

        return back();
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(LessonRequest $request, Lesson $lesson)
    {
        $request->validated();

        DB::beginTransaction();

        try {
            $lesson->name = $request->name;
            $lesson->description = $request->description;
            $lesson->level_id = $request->level_id;
            $lesson->is_free = $request->is_free;

            $lesson->save();
            DB::commit();

        } catch (\Exception $exception) {
            return back()->with("error", $exception->getMessage());
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        //
        DB::beginTransaction();

        try {
            $lesson->categories()->detach();

            $lesson->delete();
            DB::commit();

        } catch (\Exception $exception) {
            return back()->with("error", $exception->getMessage());
        }

        return back();

    }
}
