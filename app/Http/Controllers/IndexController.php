<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\ProductsImage;
use App\Banner;

class IndexController extends Controller
{
    public function index(){

        // In Ascending order (by default)
        $productAll = Product::get();
        // In Descending order
        $productAll = Product::orderBy('id','DESC')->get();
        //In Random Order
        $productAll = Product::inRandomOrder()->where('status',1)->where('feature_item',1)->paginate(6);
        // Get All Categories and subCategories
        $categories = Category::where(['parent_id' => 0])->get();
        // Get Product Alternate Image

        $banners = Banner::where('status','1')->get();
        return view('index')->with(compact('productAll', 'categories','banners'));
    }

    public function PageError(){
        return view('errors.404');
    }


}
