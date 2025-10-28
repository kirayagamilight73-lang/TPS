
# BenitezTps

## Description / Overview
**BenitezTPS** is a simple **Transaction Processing System (TPS)** developed using the **Laravel**.  
It is designed to help teachers or administrators **manage students and sections** in an academic setting.  
The system enables users to create, view, update, and delete sections and students.

## Objectives
- Provide a **centralized platform** for managing students and their assigned sections.
- Allow teachers to **create, update, and delete** class records easily.
- Offer a **digitized storage** to maintain student/section data.
- Enhance productivity and reduce manual errors in managing class info.

## Features/Functionality
- **Section Management** – Create, view, edit, and delete sections.  
- **Student Management** – Add, edit, and assign students to sections.  
- **Section-Student Relationship** – Each section can have multiple students associated with it.  
- **CRUD Operations** – Full support for Create, Read, Update, and Delete using resource controllers.  
- **Database Integration** – Utilizes migration system for structured and maintainable database tables.

## Installation Instructions

### Prerequisites
Here are the necessary tools that needs to be installed:
- [Composer](https://getcomposer.org/)
- [PHP 8.x](https://www.php.net/downloads)
- [Laravel 10+](https://laravel.com/docs/)
- [MySQL](https://www.mysql.com/)

### Setup Steps
1. **Clone the repository:**
   ```bash
   git clone https://github.com/kirayagamilight73-lang/TPS.git
2. cd TPS
3. composer install
4. cp .env.example .env
5. php artisan key:generate
6. Configure database in .env
7. php artisan migrate
8. php artisan serve
9. a link will be sent on the terminal (ctrl + click to access it)

### Usage
1. Open the web application in your browser.
2. Navigate to the. Sections page to create and manage class sections.
3. Navigate to the Students page to add students and assign them to sections.
4. Perform CRUD operations (create, update, delete) through the web interface.

### Screenshots or Code snippets
#### Routes
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return redirect()->route('sections.index');
});

Route::resource('sections', SectionController::class);
Route::resource('students', StudentController::class);
Route::get('sections/{section}/students', [SectionController::class, 'students'])->name('sections.students');

#### Section Controller
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{

    public function index()
    {
        //
        $sections = section::all();
        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate(['name' => 'required']);
        Section::create($request->all());
        return redirect()->route('sections.index');
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
    public function edit(Section $section)
    {
        //
        return view('sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        //
        $request->validate(['name' => 'required']);
        $section->update($request->all());
        return redirect()->route('sections.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        //
        $section->delete();
        return redirect()->route('sections.index');
    }

    public function students(Section $section)
    {
        $students = $section->students;
        return view('sections.students', compact('section', 'students'));
    }
}

#### Student Controller
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{

    public function index()
    {
        //
        $sections = section::all();
        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate(['name' => 'required']);
        Section::create($request->all());
        return redirect()->route('sections.index');
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
    public function edit(Section $section)
    {
        //
        return view('sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        //
        $request->validate(['name' => 'required']);
        $section->update($request->all());
        return redirect()->route('sections.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        //
        $section->delete();
        return redirect()->route('sections.index');
    }

    public function students(Section $section)
    {
        $students = $section->students;
        return view('sections.students', compact('section', 'students'));
    }
}

#### Relationship of Student and Section Models
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $fillable = ['name'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}

#### Create Student
@extends('layouts.app')

@section('content')
<h1>Add Student</h1>
<form action="{{ route('students.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Student Number</label>
        <input type="text" name="student_number" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>First Name</label>
        <input type="text" name="first_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Last Name</label>
        <input type="text" name="last_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Section</label>
        <select name="section_id" class="form-control" required>
            <option value="">-- Select Section --</option>
            @foreach($sections as $section)
                <option value="{{ $section->id }}">{{ $section->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection


#### Edit Student
@extends('layouts.app')

@section('content')
<h1>Edit Student</h1>
<form action="{{ route('students.update', $student->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Student Number</label>
        <input type="text" name="student_number" class="form-control" value="{{ $student->student_number }}" required>
    </div>
    <div class="mb-3">
        <label>First Name</label>
        <input type="text" name="first_name" class="form-control" value="{{ $student->first_name }}" required>
    </div>
    <div class="mb-3">
        <label>Last Name</label>
        <input type="text" name="last_name" class="form-control" value="{{ $student->last_name }}" required>
    </div>
    <div class="mb-3">
        <label>Section</label>
        <select name="section_id" class="form-control" required>
            @foreach($sections as $section)
                <option value="{{ $section->id }}" @if($student->section_id == $section->id) selected @endif>{{ $section->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection

#### View Students
@extends('layouts.app')

@section('content')
<h1>Students</h1>
<a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Add Student</a>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Student Number</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Section</th>
        <th>Actions</th>
    </tr>
    @foreach($students as $student)
    <tr>
        <td>{{ $student->id }}</td>
        <td>{{ $student->student_number }}</td>
        <td>{{ $student->first_name }}</td>
        <td>{{ $student->last_name }}</td>
        <td>{{ $student->section->name }}</td>
        <td>
            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection

#### Create Sections
@extends('layouts.app')

@section('content')
<h1>Add Section</h1>
<form action="{{ route('sections.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
    <a href="{{ route('sections.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection

#### Edit Sections
@extends('layouts.app')

@section('content')
<h1>Edit Section</h1>
<form action="{{ route('sections.update', $section->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $section->name }}" required>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('sections.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection

#### View Sections
@extends('layouts.app')

@section('content')
<h1>Sections</h1>
<a href="{{ route('sections.create') }}" class="btn btn-primary mb-3">Add Section</a>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Actions</th>
    </tr>
    @foreach($sections as $section)
    <tr>
        <td>{{ $section->id }}</td>
        <td>{{ $section->name }}</td>
        <td>
            <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('sections.destroy', $section->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
            <a href="{{ route('sections.students', $section->id) }}" class="btn btn-info btn-sm">View Students</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection

#### View Students in Section
@extends('layouts.app')

@section('content')
<h1>Students in Section: {{ $section->name }}</h1>

<a href="{{ route('sections.index') }}" class="btn btn-secondary mb-3">Back to Sections</a>

@if($students->count() > 0)
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Student Number</th>
        <th>First Name</th>
        <th>Last Name</th>
    </tr>
    @foreach($students as $student)
    <tr>
        <td>{{ $student->id }}</td>
        <td>{{ $student->student_number }}</td>
        <td>{{ $student->first_name }}</td>
        <td>{{ $student->last_name }}</td>
    </tr>
    @endforeach
</table>
@else
<p>No students in this section yet.</p>
@endif
@endsection

#### Student Migration
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->foreignId('section_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};


#### Section Migrations
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};


## Contributors
- Neil Basti A. Benitez
- Jorge Jose P. Abenojar


## License
N/A
