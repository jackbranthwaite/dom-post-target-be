<?php

namespace App\Http\Controllers;

use App\Http\Resources\CorrectGuessResource;
use App\Models\CorrectGuess;
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

    // public function show()
    // {
    //     $letters = DailyLetters::select('id', 'letters', 'created_at')->whereDate('created_at', Carbon::now()->format('Y-m-d'))->get();
    //     return $letters;
    // }
}
