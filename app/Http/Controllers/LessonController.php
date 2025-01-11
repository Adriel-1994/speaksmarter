<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonRequest;
use App\Models\Lesson;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $lessons = Lesson::select( 'lessons.*', 'levels.name as level_name' )
            ->join('levels', 'lessons.level_id', '=', 'levels.id')
            ->orderBy('lessons.id')->paginate(4);
//        $lessons = Lesson::join('levels', 'lessons.level_id', '=', 'levels.id')->orderBy('lessons.id')->paginate(4);
        $levels = Level::get();
        return inertia("Lessons/Index", [
            "lessons" => $lessons,
            "levels" => $levels
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

            DB::commit();

        } catch (\Exception $exception) {
            return back()->with("error", $exception->getMessage());
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
