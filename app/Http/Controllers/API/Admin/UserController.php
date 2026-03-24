<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * List users.
     */
    public function index(Request $request)
    {
        $users = User::orderByDesc('created_at')->get();

        return response()->json([
            'success' => true,
            'message' => 'Users retrieved.',
            'data' => ['users' => $users]
        ]);
    }

    /**
     * Ban or unban user.
     */
    public function ban(Request $request, $id)
    {
        // Example implementation for banning logic.
        // We'll toggle the role to 'banned' for simplicity, or we could add an 'is_banned' column.
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return response()->json(['success' => false, 'message' => 'Cannot ban admin.'], 403);
        }

        $newRole = $user->role === 'banned' ? 'earner' : 'banned';
        $user->update(['role' => $newRole]);

        return response()->json([
            'success' => true,
            'message' => "User status updated to {$newRole}.",
            'data' => ['user' => $user]
        ]);
    }
}
