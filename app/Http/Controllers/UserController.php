<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //add
    public function addUser(AddUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json([
            'message' => 'User added successfully',
            'user' => $user
        ]);
    }

    //edit
    public function editUser(EditUserRequest $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json([
            'message' => 'User edited successfully',
            'user' => $user
        ]);
    }

    //getOne
    public function getOne($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    //delete
    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->is_archive = true;
        $user->save();
        return response()->json([
            'message' => 'User deleted successfully',
            'student' => $user
        ]);
    }
}
