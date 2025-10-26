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
