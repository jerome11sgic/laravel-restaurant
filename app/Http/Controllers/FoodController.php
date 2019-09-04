<?php

namespace App\Http\Controllers;

use App\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
    public function getMainDish()
    {
        $foods = Food::select("id", "foodname", "price", "category")->where('category', "MAIN_DISH")->get();
        return $foods;
    }

    public function getSideDish()
    {
        $foods = Food::select("id", "foodname", "price", "category")->where('category', "SIDE_DISH")->get();
        return $foods;
    }
}
