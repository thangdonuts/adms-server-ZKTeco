<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a paginated listing of the users.
     */
    public function Index(Request $request)
    {
        // Fetch users with simple pagination to keep memory usage low
        $perPage = (int) $request->query('per_page', 15);
        $perPage = $perPage > 0 && $perPage <= 100 ? $perPage : 15;

        $users = User::query()
            ->orderBy('id', 'asc')
            ->simplePaginate($perPage)
            ->withQueryString();

        return view('users.index', compact('users'));
    }
}
