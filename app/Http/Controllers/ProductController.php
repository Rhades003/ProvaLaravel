<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller {
    public function getProducts(Request $request) {
        $categoryId = $request->input('categoryId');
        $type = $request->input('type'); 

        $products = Product::where('type', $type);

        if ($categoryId) {
            $products->where('category_id', $categoryId);
        }

        return response()->json($products->get());
    }

    public function searchProducts(Request $request) {
        $name = $request->name;
        $type = $request->type;
        return response()->json(Product::where('type', $type )
        ->where(function($query) use ($name) {
            $query->where('name', 'like', "%$name%")
                  ->orWhere('description', 'like', "%$name%");
        })->get());
    }

    public function getCategories(Request $request) {
        $type = $request -> input('type');
        return response()->json(Product::where('type', $type)->get()->pluck('category_id'));
    }

}
