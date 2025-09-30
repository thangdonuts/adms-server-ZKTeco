@extends('layouts.app')

@section('content')
<h2 class="mb-4">Users</h2>

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

<div>
    {{ $users->links() }}
    {{-- Pagination links --}}
    {{-- Note: Laravel's pagination styles require Tailwind by default. On Bootstrap-only setups, consider simplePaginate or custom view. --}}
</div>
@endsection
