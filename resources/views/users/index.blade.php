@extends('layouts.app')

@section('content')
<h2 class="mb-4">Users</h2>

<form method="get" action="{{ route('users.index') }}" class="row g-3 mb-3">
    <div class="col-md-4">
        <label class="form-label">Search (name or email)</label>
        <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" class="form-control" placeholder="Type name or email">
    </div>
    <div class="col-md-3">
        <label class="form-label">Created from</label>
        <input type="date" name="date_from" value="{{ $filters['date_from'] ?? '' }}" class="form-control">
    </div>
    <div class="col-md-3">
        <label class="form-label">Created to</label>
        <input type="date" name="date_to" value="{{ $filters['date_to'] ?? '' }}" class="form-control">
    </div>
    <div class="col-md-2">
        <label class="form-label">Per page</label>
        <select name="per_page" class="form-select">
            @foreach([10,15,25,50,100] as $n)
                <option value="{{ $n }}" {{ (int)($filters['per_page'] ?? 15) === $n ? 'selected' : '' }}>{{ $n }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 d-flex gap-2">
        <button type="submit" class="btn btn-primary">Apply</button>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Reset</a>
    </div>
    {{-- The filter form keeps query string clean and user-friendly --}}
</form>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-between align-items-center">
    <div class="text-muted">
        Showing {{ $users->count() }} of ~{{ method_exists($users, 'total') ? $users->total() : 'n/a' }} users
    </div>
    <div>
        {{ $users->links() }}
        {{-- Pagination links --}}
    </div>
</div>
@endsection
