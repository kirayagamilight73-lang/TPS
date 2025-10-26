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
