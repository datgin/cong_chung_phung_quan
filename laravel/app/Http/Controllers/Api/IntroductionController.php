<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Introduction;
use Illuminate\Http\Request;

class IntroductionController extends Controller
{
    public function introduction()
    {
        $introduction = Introduction::query()->firstOrCreate([]);

        return successResponse(data: $introduction);
    }
}
