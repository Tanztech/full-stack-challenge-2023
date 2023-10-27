<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class Pagination extends Controller
{
    public static function paginate($data, $Count)
    {
        $Products = $data;
        $perPage = $Count;

        $page = request()->get('page', 1);

        return new LengthAwarePaginator(
            $Products->forPage($page, $perPage),
            $Products->count(),
            $perPage,
            $page,
            ['path' => url()->current()]
        );

    }
}




