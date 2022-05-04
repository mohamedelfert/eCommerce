<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\TradeMark;

class HomeController extends Controller
{
    public function index()
    {
        $title = trans('admin.home');
        $products = Product::count();
        $trademarks = TradeMark::count();
        $manufacture = Manufacturer::count();

        $nespa = $products / $products * 100;
        $nespa1 = $trademarks / $products * 100;
        $nespa2 = $manufacture / $products * 100;

        $chartjs = app()->chartjs
            ->name('pieChartTest')
            ->type('doughnut')
            ->size(['width' => 400, 'height' => 200])
            ->labels([trans('admin.products'), trans('admin.manufacture'), trans('admin.trademarks')])
            ->datasets([
                [
                    'backgroundColor' => ['#1cae7f', '#f84f6c', '#0372e7', '#f57c3c'],
                    'hoverBackgroundColor' => ['#1cae7f', '#f84f6c', '#0372e7', '#f57c3c'],
                    'data' => [$nespa, $nespa1, $nespa2]
                ]
            ])
            ->options([]);

        return view('admin.home', compact('title', 'chartjs'));
    }
}
