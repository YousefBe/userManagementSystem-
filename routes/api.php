<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/users/create', function (Request $request) {
    $data = $request->all();
    if (!User::where('email', '=', $data['email'])->exists()) {
        // dd("a");
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        if (empty($user->id)) {
            return [
                "success" => false,
                "response" => [
                    "error" => "an unexpected error occured , try again later"
                ]
            ];
        } else {
            return [
                "success" => true,
                "response" => [
                    "user" => $user
                ]
            ];
        }
    } else {
        return [
            "success" => false,
            "response" => [
                "error" => "this user already exists"
            ]
        ];
    }
});

Route::get('/users/all', function () {
    $users = User::all();

    if (empty($users)) {
        return [
            "success" => false,
            "response" => [
                "error" => "Mafe4 Users"
            ]
        ];
    }

    return [
        "success" => true,
        "response" => [
            "users" => $users
        ]
    ];
});


route::get('users/{id}', function (Request $request, $id) {
    $user = User::find($id);
    if (empty($user)) {
        return [
            "success" => false,
            "response" => [
                "error" => "el user da m4 mawgod"
            ]
        ];
    }
    return [
        "success" => true,
        "response" => [
            "user" => $user
        ]
    ];
});

Route::delete("/users/{id}/delete", function (Request $request, $id) {
    $user = User::find($id);
    if (empty($user)) {
        return [
            "success" => false,
            "response" => [
                "error" => "el user da m4 mawgod"
            ]
        ];
    }
    $user->delete();
    return [
        "success" => true,
        "response" => [
            "message" => "User Deleted Successfully"
        ]
    ];
});

route::put("/users/{id}/update", function (Request $request, $id) {
    $user = User::find($id);
    if (empty($user)) {
        return [
            "success" => false,
            "response" => [
                "error" => "el user da m4 mawgod"
            ]
        ];
    } else {
        $data = $request->all();
        foreach ($data as $key => $value) {
            if ($key == "password") {
                $user->{$key} = Hash::make($value);
            } else {
                $user->{$key} = $value;
            }
        }
        $result = $user->save();
        return [
            "success" => $result,
            "response" => [
                "user" => $user
            ]
        ];
    }
});
