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
