<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        return view('index');
    }

    public function changeLanguage($locale)
    {
        if (!in_array($locale, config('available_languages.languages_codes'))) {
            abort(404, 'Selection error');
        }

        if (auth()->user()) {
            auth()->user()->language = $locale;
            auth()->user()->save();
        }
        session()->put('locale', $locale);
        return back();
    }

    public function changeTheme($theme)
    {
        if (!array_key_exists($theme, config('available_themes'))) {
            abort(404, 'Selection error');
        }

        if (auth()->user()) {
            auth()->user()->theme = $theme;
            auth()->user()->save();
        }
        return back();
    }

}
