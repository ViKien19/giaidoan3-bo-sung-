<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json(['data' => $users, 'total' => $users->count()]);
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json(['data' => $user]);
        }
        return response()->json(['message' => 'Người dùng không tồn tại'], 404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required|integer',
            'fullname' => 'required|string|max:255',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'fullname' => $request->fullname,
        ]);

        return response()->json(['message' => 'Thêm người dùng thành công', 'data' => $user], 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Người dùng không tồn tại'], 404);
        }

        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role_id' => 'required|integer',
            'fullname' => 'required|string|max:255',
        ]);

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role_id' => $request->role_id,
            'fullname' => $request->fullname,
        ]);

        return response()->json(['message' => 'Cập nhật người dùng thành công', 'data' => $user]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'Xóa người dùng thành công']);
        }
        return response()->json(['message' => 'Người dùng không tồn tại'], 404);
    }
}