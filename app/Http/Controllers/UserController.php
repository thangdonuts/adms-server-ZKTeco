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
        // Parse filters from query string safely
        $searchQuery = trim((string) $request->query('q', ''));
        $dateFrom = $request->query('date_from');
        $dateTo = $request->query('date_to');

        // Fetch users with simple pagination to keep memory usage low
        $perPage = (int) $request->query('per_page', 15);
        $perPage = $perPage > 0 && $perPage <= 100 ? $perPage : 15;

        $usersQuery = User::query();

        // Apply full-text like filtering on name/email
        if ($searchQuery !== '') {
            $usersQuery->where(function ($q) use ($searchQuery) {
                $q->where('name', 'like', "%{$searchQuery}%")
                  ->orWhere('email', 'like', "%{$searchQuery}%");
            });
        }

        // Apply date range on created_at if provided
        if (!empty($dateFrom)) {
            $usersQuery->whereDate('created_at', '>=', $dateFrom);
        }
        if (!empty($dateTo)) {
            $usersQuery->whereDate('created_at', '<=', $dateTo);
        }

        $users = $usersQuery
            ->orderBy('id', 'asc')
            ->simplePaginate($perPage)
            ->withQueryString();

        return view('users.index', [
            'users' => $users,
            'filters' => [
                'q' => $searchQuery,
                'date_from' => $dateFrom,
                'date_to' => $dateTo,
                'per_page' => $perPage,
            ],
        ]);
    }
}
