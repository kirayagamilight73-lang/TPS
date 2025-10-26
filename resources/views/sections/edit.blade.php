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
