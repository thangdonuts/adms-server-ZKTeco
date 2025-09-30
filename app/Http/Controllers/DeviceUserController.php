<?php

namespace App\Http\Controllers;

use App\Models\DeviceUser;
use Illuminate\Http\Request;

class DeviceUserController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $sn = $request->query('sn');
        $perPage = (int) $request->query('per_page', 15);
        $perPage = $perPage > 0 && $perPage <= 100 ? $perPage : 15;

        $query = DeviceUser::query();
        if ($sn) { $query->where('sn', $sn); }
        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('user_id', 'like', "%{$q}%")
                    ->orWhere('name', 'like', "%{$q}%")
                    ->orWhere('card_no', 'like', "%{$q}%");
            });
        }

        $deviceUsers = $query->orderBy('sn')->orderBy('user_id')->simplePaginate($perPage)->withQueryString();

        return view('device_users.index', [
            'deviceUsers' => $deviceUsers,
            'filters' => ['q' => $q, 'sn' => $sn, 'per_page' => $perPage],
        ]);
    }
}
