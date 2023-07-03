<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;

class SearchController extends Controller
{
    public function search($name)
    {
        return Client::where("name", $name)->get;
    }
}
