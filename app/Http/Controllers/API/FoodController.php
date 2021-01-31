<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FoodController extends Controller
{
    public function all(Request $request) {
        $id = $request->input('id');
        $limit = $request->input('limit',6);
        $nameFood = $request->input('name_food');
        $typeFood = $request->input('type_food');

        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');

        $rate_from = $request->input('rate_from');
        $rate_to = $request->input('rate_to');

        if($id) {
            $food = Food::find($id);
            if ($food) {
                return ResponseFormatter::success(
                    $food, 'Data produk berhasil di ambil'
                );
            } else {
                return ResponseFormatter::error(
                    null, 'Data produk tidak ada',404
                );
            }
        }

        $food = Food::query();

        if($nameFood) {
            $food->where('name_food', 'like', '%' . $nameFood . '%');
        }

        if($typeFood) {
            $food->where('type_food', 'like', '%' . $typeFood . '%');
        }

        if($price_from) {
            $food->where('price_food', '>=', $price_from);
        }

        if($price_to) {
            $food->where('price_food', '<=', $price_to);
        }

        if($rate_from) {
            $food->where('rate_food', '<=', $rate_from);
        }

        if($rate_to) {
            $food->where('rate_food', '<=', $rate_to);
        }


        return ResponseFormatter::success(
            $food->paginate($limit),
            'Data list product berhasil di ambil',
        );
    }
}
