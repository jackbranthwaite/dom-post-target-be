<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function show(Request $request)

    {
        if ($request->id) {
            return new UserResource(User::find($request->id));
        } else {
            return new UserResource($request->user());
        }
    }

    /**
     * Update user data
     */
    public function update(Request $request): UserResource
    {
        /**
         * @var \App\User
         */
        $user = $request->user();

        $user->save();

        return new UserResource($user);
    }
}
