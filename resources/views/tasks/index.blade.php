@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">My Todo List</h4>
            </div>
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="What do you need to do?" value="{{ old('title') }}">
                        <button type="submit" class="btn btn-primary">Add Task</button>
                    </div>
                    @error('title')
                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                    @enderror
                </form>

                <ul class="list-group">
                    @foreach ($tasks as $task)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="me-3">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $task->is_completed ? 'btn-success' : 'btn-outline-secondary' }}">
                                        {{ $task->is_completed ? '✓' : '○' }}
                                    </button>
                                </form>

                                <span class="{{ $task->is_completed ? 'text-decoration-line-through text-muted' : '' }}">
                                    {{ $task->title }}
                                </span>
                            </div>

                            <div class="d-flex">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>

                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirmDelete()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this task?');
    }
</script>
@endsection