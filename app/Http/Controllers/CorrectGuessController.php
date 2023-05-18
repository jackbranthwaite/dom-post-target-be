<?php

namespace App\Http\Controllers;

use App\Http\Resources\CorrectGuessResource;
use App\Models\CorrectGuess;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CorrectGuessController extends Controller
{
    public function store(Request $request): CorrectGuessResource
    {

        $user = Auth::user();
        if ($user) {
            $correctGuess = new CorrectGuess([
                'hours' => $request->input('hours'),
                'minutes' => $request->input('minutes'),
                'seconds' => $request->input('seconds'),
                'user_id' => $user->id
            ]);

            $correctGuess->save();

            return new CorrectGuessResource($correctGuess);
        };
    }

    public function show()
    {
        $correctGuess = CorrectGuess::select()->whereDate('created_at', Carbon::now()->format('Y-m-d'))->where('user_id', Auth::user()->id)->get();
        if ($correctGuess) {
            return $correctGuess;
        } else {
            return false;
        }
    }
}
