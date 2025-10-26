<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Section;

class StudentController extends Controller
{

    public function index()
    {
        //
        $students = Student::with('section')->get();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $sections = Section::all();
        return view('students.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'student_number' => 'required|unique:students',
            'first_name' => 'required',
            'last_name' => 'required',
            'section_id' => 'required|exists:sections,id',
        ]);

        Student::create($request->all());
        return redirect()->route('students.index');
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
    public function edit(Student $student)
    {
        //
        $sections = Section::all();
        return view('students.edit', compact('student', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
        $request->validate([
            'student_number' => 'required|unique:students,student_number,' . $student->id,
            'first_name' => 'required',
            'last_name' => 'required',
            'section_id' => 'required|exists:sections,id',
        ]);

        $student->update($request->all());
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
        $student->delete();
        return redirect()->route('students.index');
    }
}
