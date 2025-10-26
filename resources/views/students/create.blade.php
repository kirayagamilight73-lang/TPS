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
