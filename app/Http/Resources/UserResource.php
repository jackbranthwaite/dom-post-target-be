<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'is_admin' => $this->is_admin
        ];
    }

    /**
     * Retrieve a value based on a whether the authenticated user is the resource.
     *
     * @param  mixed  $value
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    public function whenAuthorized($value)
    {
        return $this->when(Auth::guard()->user()->id === $this->id, $value);
    }
}
