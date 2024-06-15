<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            $sortBy = $request->get('sort_by', 'created_at'); // Default column to sort by
            $sortDirection = $request->get('sort_direction', 'desc'); // Default sort direction
            $showDeleted = $request->get('show_deleted', 'no'); // Default to not showing deleted
            $searchTerm = $request->get('search_term', '');

            if (!in_array($sortDirection, ['asc', 'desc'])) {
                $sortDirection = 'desc';
            }
            $query = User::query();
            if ($showDeleted === 'yes') {
                $query = $query->withTrashed();
            }
            if ($searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('id', 'like', "%$searchTerm%")
                        ->orWhere('name', 'like', "%$searchTerm%")
                        ->orWhere('email', 'like', "%$searchTerm%")
                        ->orWhere('level', 'like', "%$searchTerm%")
                        ->orWhere('phone', 'like', "%$searchTerm%")
                        ->orWhere('town_city', 'like', "%$searchTerm%")
                        ->orWhere('street_address', 'like', "%$searchTerm%")
                        ->orWhere('country', 'like', "%$searchTerm%")
                        ->orWhere('updated_at', 'like', "%$searchTerm%")
                        ->orWhere('created_at', 'like', "%$searchTerm%");
                });
            }
            if ($sortBy) {
                $query->orderBy($sortBy, $sortDirection);
            }


            $users = $query->paginate(10);

            return view('admin.user.index', compact('users', 'sortBy', 'sortDirection', 'searchTerm', 'showDeleted'));
        } catch (\Exception $exception) {
            return back()->with('error', 'Something went wrong, please try again!');
        }
    }
}
