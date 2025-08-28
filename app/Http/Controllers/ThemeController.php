<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ThemeController extends Controller
{
    /**
     * Set the theme for the user's session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function set(Request $request)
    {
        $availableThemes = config('daisyui.themes', ['light']);

        $validator = Validator::make($request->all(), [
            'theme' => 'required|string|in:' . implode(',', $availableThemes),
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => 'Invalid theme specified.'], 400);
        }

        session(['theme' => $validator->validated()['theme']]);

        return response()->json(['status' => 'success']);
    }
}
