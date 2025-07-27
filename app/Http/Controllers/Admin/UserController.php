<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');

        // Validate sort columns
        $allowedSorts = ['nama', 'email', 'role', 'created_at'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'created_at';
        }

        $query->orderBy($sortBy, $sortOrder);

        // Per page
        $perPage = $request->get('per_page', 10);
        if (!in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }

        $users = $query->paginate($perPage)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,guru',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($user_id)
    {
        $user = User::where('user_id', $user_id)->firstOrFail();
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $user_id)
    {
        $user = User::where('user_id', $user_id)->firstOrFail();

        $request->validate([
            'nama' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $user_id . ',user_id',
            'role' => 'required|in:admin,guru',
        ]);

        $data = $request->only(['nama', 'email', 'role']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate');
    }

    public function destroy($user_id)
    {
        $user = User::where('user_id', $user_id)->firstOrFail();
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus');
    }
}
