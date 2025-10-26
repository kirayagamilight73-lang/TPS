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
