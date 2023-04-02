<?php

namespace App\Http\Controllers;

use App\Http\Resources\DailyLettersResource;
use App\Models\DailyLetters;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DailyLettersController extends Controller
{
    /**
     * Get the pepeha record associated with the user.
     */
    public function store(Request $request): DailyLettersResource

    {
        $user = Auth::user();
        if ($user->is_admin) {
            $dailyLetters = new DailyLetters([
                'letters' => $request->input('letters')
            ]);

            $dailyLetters->save();

            return new DailyLettersResource($dailyLetters);
        };
    }

    public function show()
    {
        $letters = DailyLetters::select('id', 'letters', 'created_at')->whereDate('created_at', Carbon::now()->format('Y-m-d'))->get();
        return $letters;
    }
}
