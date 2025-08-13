<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function form()
    {
        $slider = Slider::query()->first();
        return view('pages.sliders.form', compact('slider'));
    }

    public function save(SliderRequest $request)
    {
        $credentials = $request->validated();

        return transaction(function () use ($credentials) {

            $slider = Slider::query()->first();

            !$slider ? Slider::create($credentials) :  $slider->update($credentials);

            return successResponse(message: 'Lưu slider thành công!', isToastr: false);
        });
    }
}
