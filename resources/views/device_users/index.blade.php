@extends('layouts.app')

@section('content')
<h2 class="mb-4">Device Users</h2>

<form method="get" action="{{ route('device_users.index') }}" class="row g-3 mb-3">
    <div class="col-md-3">
        <label class="form-label">Device SN</label>
        <input type="text" name="sn" value="{{ $filters['sn'] ?? '' }}" class="form-control" placeholder="Serial number">
    </div>
    <div class="col-md-5">
        <label class="form-label">Search (ID/Name/Card)</label>
        <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" class="form-control" placeholder="Search keyword">
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
        <a href="{{ route('device_users.index') }}" class="btn btn-outline-secondary">Reset</a>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>SN</th>
                <th>User ID</th>
                <th>Name</th>
                <th>Card No</th>
                <th>Privilege</th>
                <th>Group</th>
                <th>Timezone</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
            @forelse($deviceUsers as $du)
                <tr>
                    <td>{{ $du->sn }}</td>
                    <td>{{ $du->user_id }}</td>
                    <td>{{ $du->name }}</td>
                    <td>{{ $du->card_no }}</td>
                    <td>{{ $du->privilege }}</td>
                    <td>{{ $du->group }}</td>
                    <td>{{ $du->timezone }}</td>
                    <td>{{ $du->updated_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No device users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-end">
    {{ $deviceUsers->links() }}
</div>
@endsection
