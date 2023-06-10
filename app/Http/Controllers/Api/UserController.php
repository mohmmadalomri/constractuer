<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response()->json([
            'status' => true,
            'users' => $users
        ]);
    }

    public function store(StoreUserRequest $request)
    {

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['birth_day'] = $request->birth_day ? $request->birth_day : Carbon::now();
        $data['password'] = bcrypt($request->password);
        $image = $request->file('image');
        $data['image'] = $this->images($image, null);

        $user = User::create($data);

        return response()->json([
            'status' => true,
            'message' => 'User Created Successfully',
            'user' => $user,
        ]);
    }


    public function show($id)
    {
        $user = User::find($id);
//        $user = User::with(['employee'])->findOrFail($id);
        return response()->json([
            'status' => true,
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        //

        $user = User::findOrFail($id);
        if ($user) {
            $data['name'] = $request->name ? $request->name : $user->name;
            $data['email'] = $request->email ? $request->email : $user->email;
            $data['phone'] = $request->phone ? $request->phon : $user->phone;
            $data['birth_day'] = $request->birth_day ? $request->birth_day : Carbon::now();

            if ($request->hasFile('image')) {

                $oldimage = $user->image;
                $image = $request->file('image');
                $data['image'] = $this->images($image, $oldimage);

            }

        }

        $user->update($data);
        return response()->json([
            'status' => true,
            'data' => $user,
            'message' => 'User Updated Successfully',
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'status' => true,
            'message' => 'User deleted Successfully',
        ]);
    }

    // function to change_password
    public function change_password(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $user = User::findOrFail($id);
        if (Hash::check($request->current_password, $user->password)) {
            $update = $user->update([
                'password' => bcrypt($request->password),
            ]);

            if ($update) {
                return response()->json([
                    'status' => true,
                    'message' => 'User cahnge_password  Successfully',
                ], 200);
            }
        }
    }
}
