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
