<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function index()
    {
        $search = request('tag');

        $locale = $locale ?? app()->getLocale();

        return \Spatie\Tags\Tag::query()
            ->where("name->{$locale}", 'LIKE', "%$search%")
            ->take(5)
            ->pluck("name");
    }
}
