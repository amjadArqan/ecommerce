<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\ProductsAttribute;
use App\ProductsImage;
use App\Coupon;
use App\User;
use App\Country;
use App\DeliveryAddress;
use App\Order;
use App\OrdersProduct;
use App\Banner;
use Auth;
use Image;
use Session;
use DB;

class ProductsController extends Controller
{
    public function addProduct(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data);die;
            if(empty($data['category_id'])){
                return redirect()->back()->with('flash_message_error','Under Category is missing!');

            }
            $product = new Product;
            $product->category_id  = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color  = $data['product_color'];
            if(!empty($data['description'])){
                $product->description  = $data['description'];
            }else{
                $product->description  = '';
            }
            if(!empty($data['care'])){
                $product->care  = $data['care'];
            }else{
                $product->care  = '';
            }
            $product->price  = $data['price'];

            //uploade Image
            if($request->hasFile('image')){
                $image_tmp  = Input::file('image');
                if($image_tmp->isValid()){
                    $extension  =  $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).".".$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
                   // Resize Image Code
                   Image::make($image_tmp)->save($large_image_path);
                   Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                   Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                   // Store image name in product table
                   $product->image =  $filename ;
                }
            }

            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1;

            }
            if(empty($data['feature_item'])){
                $feature_item = 0;
            }else{
                $feature_item = 1;

            }

            $product->feature_item = $feature_item ;
            $product->status = $status ;
            $product->save();
            return redirect('/admin/view-products')->with('flash_message_Success','Product has been  Added Successfuly!');
        }
        // Category drop down Start
        $category = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option selected disabled>Select</option>";
        foreach($category as $cat){
            $categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get(); 
            foreach($sub_categories as $sub_cat){
                $categories_dropdown .= "<option value='".$sub_cat->id."'>&nbsp;--&nbsp".$sub_cat->name."</option>";

            }

        }
        // Category drop down End


        return view('admin.products.add-product')->with(compact('categories_dropdown'));
    }

     public function editProduct(Request $request , $id = null){

        if($request->ismethod('post')){
            $data = $request->all();
            //echo print_r($data); die;

            //uploade Image
            if($request->hasFile('image')){
                $image_tmp  = Input::file('image');
                if($image_tmp->isValid()){
                    $extension  =  $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).".".$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
                   // Resize Image Code
                   Image::make($image_tmp)->save($large_image_path);
                   Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                   Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                   // Store image name in product table
            }
       }
       else{
                $filename = $data['current_image'];
            }
            if(empty($data['description'])){
                $data['description'] = "";
            }
            if(empty($data['care'])){
                $data['care'] = "";
            }

            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1;

            }
            if(empty($data['feature_item'])){
                $feature_item = 0;
            }else{
                $feature_item = 1;

            }
            Product::where(['id'=>$id])->update([
                'category_id' => $data['category_id'],
                'product_name' => $data['product_name'],
                'product_code' => $data['product_code'],
                'product_color' => $data['product_color'],
                'description' => $data['description'],
                'care' => $data['care'],
                'status' => $status,
                'feature_item' => $feature_item,
                'price' => $data['price'],
                'image' => $filename
            ]);

            return redirect()->back()->with('flash_message_Success','Product  Has been update Successfuly');
        }
         // get product details
         $productdetails = Product::where(['id' => $id])->first();

        // Category drop down Start
        $category = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option selected disabled>Select</option>";
        foreach($category as $cat){
            if($cat->id==$productdetails->category_id ){
                $selected = "selected";
                $categories_dropdown .= "<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";

            }else{
                $categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";

            }
            $sub_categories = Category::where(['parent_id' => $cat->id])->get(); 
            foreach($sub_categories as $sub_cat){
                if($sub_cat->id == $productdetails->category_id ){
                    $selected = "selected";
                   $categories_dropdown .= "<option value='".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp".$sub_cat->name."</option>";

                }else{
                    $categories_dropdown .= "<option value='".$sub_cat->id."'>&nbsp;--&nbsp".$sub_cat->name."</option>";

                }
            }
        }
        // Category drop down End


         return view('admin.products.edit-product')->with(compact('productdetails','categories_dropdown'));

    }


    public function viewProduct(){
        $products = Product::orderBy('id','DESC')->get();
        foreach($products as $key => $val){
            $category_name = Category::where(['id' => $val->category_id])->first();
            if(!empty($category_name )){
                $products[$key]->category_name = $category_name->name;
            }

        }
        //echo "<pre>";print_r($products);die;
        return view('admin.products.view-product')->with(compact('products'));
    }

    public function deleteProductImage($id = null){
        //Get Product Image Name
        $productImage = Product::where(['id' => $id])->first();

        // Get Product Image Pathe 
        $large_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        //Delete Large Image if not exists is in Folder
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }

        //Delete medium Image if not exists is in Folder
        if(file_exists($medium_image_path.$productImage->image)){
                    unlink($medium_image_path.$productImage->image);
        }

        //Delete small Image if not exists is in Folder
        if(file_exists($small_image_path.$productImage->image)){
                unlink($small_image_path.$productImage->image);
        }

        Product::where(['id' => $id])->update(['image' => " "]);
        return redirect()->back()->with('flash_message_Success','Product  Image Has been Deleted Successfuly');

    }


    public function deleteAltImage($id = null){
        //Get Product Image Name
        $productImage = ProductsImage::where(['id' => $id])->first();

        // Get Product Image Pathe 
        $large_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        //Delete Large Image if not exists is in Folder
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }

        //Delete medium Image if not exists is in Folder
        if(file_exists($medium_image_path.$productImage->image)){
                    unlink($medium_image_path.$productImage->image);
        }

        //Delete small Image if not exists is in Folder
        if(file_exists($small_image_path.$productImage->image)){
                unlink($small_image_path.$productImage->image);
        }

        ProductsImage::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_Success','Product  Image Has been Deleted Alternate Image(s) Successfuly');

    }

    public function deleteProduct($id = null){
        Product::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_Success','Product  Has been deleted Successfuly');

    }

    public function addAttributes (Request $request , $id = null){
            $productDetails = Product::with('attributes')->where(['id' => $id])->first();
            if($request->isMethod('post')){
                $data = $request->all();
                foreach($data['sku'] as $key  => $val){
                   if(!empty($val)){
                       // Prevent duplicate SKU Check
                       $attrCountSKU = ProductsAttribute::where('sku',$val)->count();
                       if($attrCountSKU > 0){
                        return redirect('/admin/add-attributes/'.$id)->with('flash_message_error',''.$val.' / SKU already exists ! Pleas add another SKU.');

                       }
                        // Prevent duplicate Size Check
                        $attrCountSize = ProductsAttribute::where(['product_id' => $id , 'size' => $data['size'][$key]])->count();
                        if($attrCountSize > 0){
                            return redirect('/admin/add-attributes/'.$id)->with('flash_message_error',''.$data['size'][$key].'  / Size already exists ! Pleas add another Size.');

                        }
                        

                        $attribute = new ProductsAttribute();
                        $attribute->product_id  = $id ;
                        $attribute->sku = $val;
                        $attribute->size = $data['size'][$key];
                        $attribute->price = $data['price'][$key];
                        $attribute->stock = $data['stoke'][$key];
                        $attribute->save();
                }
            }


            return redirect('/admin/add-attributes/'.$id)->with('flash_message_Success','Product Attribute  Has been update Successfuly');
        }
            return view('admin.products.add_attributes')->with(compact('productDetails'));
    }

    public function editAttributes (Request $request , $id = null){
         if( $request->isMethod('post')){
             $data = $request->all();
             foreach($data['idAttr'] as $key => $attr){
                ProductsAttribute::where(['id' => $data['idAttr'][$key]])->update(['price' => $data['price'][$key], 'stock' => $data['stock'][$key] ]);
             }
             return redirect()->back()->with('flash_message_success','Product Attribute Has been update successfully!');

         }
    }

    public function addImages (Request $request , $id = null){
        $productDetails = Product::with('attributes')->where(['id' => $id])->first();
        if($request->isMethod('post')){
            $data = $request->all();
             if($request->hasFile('image')){
               $files = $request->file('image');
               foreach($files as $file){
                    $image = new ProductsImage;
                    $extension  =   $file->getClientOriginalExtension();
                    $filename = rand(111,99999).".".$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
                    Image::make($file)->save($large_image_path);
                    Image::make($file)->resize(600,600)->save($medium_image_path);
                    Image::make($file)->resize(300,300)->save($small_image_path);
                    $image->image =  $filename;
                    $image->product_id =  $data['product_id'];
                    $image->save();
               }
            }

        return redirect('/admin/add-images/'.$id)->with('flash_message_Success','Product Attribute  Has been update Successfuly');
        }
        $productImg = ProductsImage::where(['product_id' => $id])->get();
        $productImages = "";
        foreach($productImg as $img){
            $productImages .= "<tr>
               <td>".$img->id."</td>
               <td>".$img->product_id."</td>
                <td><img src='/images/backend_images/products/small/$img->image' style='width:50px'></td>
                <td>
                   <a href='javascript:'' rel='$img->id' rel1='delete-alt-image' class='btn btn-danger btn-mini deleteRecord' title='delete product image'>Delete</a>
                </td>
        </tr>";
        }

 


        return view('admin.products.add_images')->with(compact('productDetails', 'productImages'));
}
    

    public function deleteAttribute( $id = null){
        ProductsAttribute::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_error','Attribute Has Been deleted Successfuly!');

    }

    public function products($url = null){

        // Show 404 Page if Category URL does not exist
        $Countcategory = Category::where(['url' => $url, 'status' => 1])->count();
        if($Countcategory == 0 ){
            abort(404);
        }
        $categories = Category::where(['parent_id' => 0])->get();

        $categoryDetalies = Category::where(['url' => $url])->first();
            if($categoryDetalies->parent_id == 0){
                // IF url Is Main Category URL
                $SubCategories = Category::where(['parent_id' => $categoryDetalies->id])->get();
                foreach($SubCategories as $subcat){
                    $cats_ids[] = $subcat->id;
                }
                $productAll = Product::whereIn('category_id', $cats_ids)->where('status',1)->paginate(6);
            }
            else{
             // IF url Is Sub Category URL
              $productAll = Product::where(['category_id' => $categoryDetalies->id])->where('status',1)->paginate(6);

            }
            return view('products.listing')->with(compact('categories','categoryDetalies','productAll'));

        

    }



    public function searchProducts(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $categories = Category::with('categories')->where(['parent_id' => 0 ])->get();
            $search_product = $data['product'];
            if(empty($data['product'])){
                return redirect('/');

                
            }
            $productAll = Product::where('product_name','like','%'.$search_product.'%')->orwhere('product_code',$search_product)->where('status',1)->get();
            return view('products.listing')->with(compact('categories','productAll','search_product'));

        }

    }

    public function product($id = null){
        // Show 404 Page if product is disabled
        $productCount = Product::where(['id' => $id,'status'=>1])->count();
        if( $productCount == 0){
            abort(404);
        }

        $productDetails = Product::with('attributes')->where(['id' => $id])->first();
        $productDetails = json_decode(json_encode($productDetails));
        //echo "<pre>";print_r($productDetails);die;
        $relatedProducts= Product::where('id','!=',$id)->where(['category_id' =>  $productDetails->category_id])->get();
        /*
        foreach($relatedProducts->chunk(3) as $chunk){
            foreach ($chunk as $item){
                echo $item; echo "<br>";
            }echo "<br><br><br>";
        }die();
        */
        $categories = Category::where(['parent_id' => 0])->get();
        $productAltImage = ProductsImage::where('product_id',$id)->get();
        $total_stock = ProductsAttribute::where('product_id',$id)->sum('stock');

        return view('products.detail')->with(compact('productDetails','categories','productAltImage','total_stock','relatedProducts'));
    }

    public function getProductPrice(Request $request){
          $data = $request->all();
          //echo "<pre>";print_r($data);die;
          $proArr = explode("-",$data['idSize']);
          $proAttr = ProductsAttribute::where(['product_id' => $proArr[0], 'size' => $proArr[1] ])->first();
          echo $proAttr->price;
          echo '#';
          echo $proAttr->stock;

    }

    public function addtocart(Request $request){
        Session::forget('couponamount');
        Session::forget('CouponCode');
         $data = $request->all();
         //echo "<pre>";print_r($data);die;

         // Check Product Stock is available or not
         $product_size = explode("-",$data['size']);
         $getProductStock = ProductsAttribute::where(['product_id' => $data['product_id'], 'size' => $product_size[1]])->first();
         if( $getProductStock->stock < $data['quantity']){
             return redirect()->back()->with('flash_message_error','Required Quantity Is Not available !');
         }

         if(empty(Auth::user()->email)){
            $data['user_email'] = '';
        }else {
           $data['user_email'] = Auth::user()->email;
        }


         $session_id = Session::get('session_id');
        if(empty( $session_id)){
            $session_id = str_random(40);
            Session::put('session_id',$session_id);
        }
         

        $sizeArr = explode("-",$data['size']);
        $product_size = $sizeArr[1];
       if(empty(Auth::check())){
            $countProduct = DB::table('cart')->where(['product_id' => $data['product_id'],
                            'product_color' => $data['product_color'],
                            'size' =>  $product_size,
                            'session_id' => $session_id])->count();
            if($countProduct  > 0){
                return redirect()->back()->with('flash_message_error','Product already exists in cart!');

            }
       }else{
            $countProduct = DB::table('cart')->where(['product_id' => $data['product_id'],
            'product_color' => $data['product_color'],
            'size' =>  $product_size,
            'user_email' =>  $data['user_email']] )->count();
            if($countProduct  > 0){
                 return redirect()->back()->with('flash_message_error','Product already exists in cart!');
            }
       }

           $getSKU = ProductsAttribute::select('sku')->where(['product_id' => $data['product_id'] , 'size' => $sizeArr[1]])->first();

            DB::table('cart')->insert(['product_id' => $data['product_id'],
            'product_name' => $data['product_name'],
            'product_code' => $getSKU->sku,
            'product_color' => $data['product_color'],
            'price' => $data['product_price'],
            'size' => $sizeArr[1],
            'quantity' => $data['quantity'],
            'user_email' => $data['user_email'],
            'session_id' => $session_id]);



            return redirect('cart')->with('flash_message_Success','Product has been added in Cart!');
    }

    public function cartPage(){

        if(Auth::check()){
            $user_email = Auth::user()->email;
            $user_cart = DB::table('cart')->where(['user_email' => $user_email])->get();


        }else{
            $session_id = Session::get('session_id');
            $user_cart = DB::table('cart')->where(['session_id' => $session_id])->get();
        }
        foreach($user_cart as $key => $product){
            $productDetails = Product::where('id',$product->product_id)->first();
            $user_cart[$key]->image = $productDetails->image;
        }

        return view('products.cart')->with(compact('user_cart'));
    }

    public function deleteCartProduct($id = null){
        Session::forget('couponamount');
        Session::forget('CouponCode');
        DB::table('cart')->where('id',$id)->delete();
        return redirect('cart')->with('flash_message_Success','Product has been added from Cart!');

    }

    public function updateCartQuantity($id = null , $quantity = null){
        Session::forget('couponamount');
        Session::forget('CouponCode');
        $getCartDetails = DB::table('cart')->where('id',$id)->first();
        $getAttributeStock = ProductsAttribute::where('sku',$getCartDetails->product_code)->first();
        $updated_quantity = $getCartDetails->quantity + $quantity;
        if($getAttributeStock->stock >= $updated_quantity){
            DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
             return redirect('cart')->with('flash_message_Success','Product Quantity Has been updated Successfuly!');
        }else{
            return redirect('cart')->with('flash_message_error','Required Product Quantity is not available!');

        }


    }

    public function applyCoupon(Request $request){

           Session::forget('couponamount');
           Session::forget('CouponCode');

           $data = $request->all();
           $couponCount = Coupon::where('coupon_code',$data['coupon_code'])->count();
           if($couponCount  == 0 ){
               return redirect()->back()->with('flash_message_error','This coupon does Not Exits!');
           }else{
               // With perform other check like Active/ In Active, Expiry date ....

               // Get Coupon Details
               $couponDetails = Coupon::where('coupon_code',$data['coupon_code'])->first();
                 if($couponDetails->status == 0){
                     return redirect()->back()->with('flash_message_error','This coupon Is Not Active!');
                }
                // IF Coupon is Expire
                $expiry_date = $couponDetails->expiry_date;
                $current_date = date('Y-m-d');
                if($expiry_date < $current_date){
                    return redirect()->back()->with('flash_message_error','This coupon Is expired!');
                }


                // Coupon is valid For Discount

                // Get Cart Total Amount
                if(Auth::check()){
                    $user_email = Auth::user()->email;
                    $user_cart = DB::table('cart')->where(['user_email' => $user_email])->get();
        
        
                }else{
                    $session_id = Session::get('session_id');
                    $user_cart = DB::table('cart')->where(['session_id' => $session_id])->get();
                }




                $total_amount = 0 ;
                foreach($user_cart as $item){
                    $total_amount = $total_amount + ($item->price * $item->quantity );
                }

                // Check if amount is Fixed or Precentage
                if($couponDetails->amount_type == "fixed"){
                    $couponamount = $couponDetails->amount;
                }else{
                    $couponamount = $total_amount * ( $couponDetails->amount / 100);

                }


                // Add Coupone Code & Amount in Session
                Session::put('couponamount', $couponamount);
                Session::put('CouponCode', $data['coupon_code']);
                return redirect()->back()->with('flash_message_Success','coupon Code Successfuly applied You are availing discount!');

           }
    }

    public function checkout(Request $request){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;

        $userDetails = User::find($user_id);
        $countries = Country::get();
        // Check if Shipping Address exists
        $shippingCount = DeliveryAddress::where('user_id', $user_id)->count();
        $shippingDetails = array();
        if($shippingCount > 0 ){
            $shippingDetails  = DeliveryAddress::where('user_id', $user_id)->first();
        }
        // Update cart table With User email
         $session_id = Session::get('session_id');
         DB::table('cart')->where(['session_id' => $session_id])->update(['user_email' => $user_email]);

        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['billing_name']) || empty($data['billing_address']) || empty($data['billing_city']) || 
               empty($data['billing_state']) || empty($data['billing_country']) || empty($data['billing_pincode']) ||
               empty($data['billing_mobile']) || empty($data['shipping_name']) || empty($data['shipping_address']) ||
               empty($data['shipping_city']) || empty($data['shipping_state']) || empty($data['shipping_country']) || 
               empty($data['shipping_pincode']) || empty($data['shipping_mobile'])){

               return redirect()->back()->with('flash_message_error','Please fill all fields to checkout!');

            } 


            // Update User details
            User::where('id',$user_id)->update([
                'name' => $data['billing_name'] , 'address' => $data['billing_address'] , 'city' => $data['billing_city'],
                'state' => $data['billing_state'] , 'country' => $data['billing_country'] , 'pincode' => $data['billing_pincode'],
                'mobile' => $data['billing_mobile']
            ]);

            if($shippingCount > 0 ){
                // Update Shipping Address
                DeliveryAddress::where('user_id', $user_id)->update([
                    'name' => $data['shipping_name'] , 'address' => $data['shipping_address'] , 'city' => $data['shipping_city'],
                    'state' => $data['shipping_state'] , 'country' => $data['shipping_country'] , 'pincode' => $data['shipping_pincode'],
                    'mobile' => $data['shipping_mobile']
                ]);;
            }
            else{
               // Add New Shipping Address
               $shipping =   new DeliveryAddress;
               $shipping->user_id = $user_id;
               $shipping->user_email = $user_email;
               $shipping->name = $data['shipping_name'];
               $shipping->address = $data['shipping_address'];
               $shipping->city = $data['shipping_city'];
               $shipping->state = $data['shipping_state'];
               $shipping->country = $data['shipping_country'];
               $shipping->pincode = $data['shipping_pincode'];
               $shipping->mobile = $data['shipping_mobile'];
               $shipping->save();
            }

            return redirect()->action('ProductsController@orderReview');

        }
        return view('products.checkout')->with(compact('userDetails','countries', 'shippingDetails'));
    }


    public function orderReview(Request $request){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::where('id', $user_id)->first();
        $shippingDetails  = DeliveryAddress::where('user_id', $user_id)->first();
        $user_cart = DB::table('cart')->where(['user_email' => $user_email])->get();
        foreach($user_cart as $key => $product){
            $productDetails = Product::where('id',$product->product_id)->first();
            $user_cart[$key]->image = $productDetails->image;
        }
        return view('products.order_review')->with(compact('shippingDetails','userDetails','user_cart'));
    }

    public function placeOrder(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;
            $shippingDetails  = DeliveryAddress::where('user_email', $user_email)->first();
            if(empty(Session::get('CouponCode'))){
                $coupone_code = "";
            }else{
                $coupone_code = Session::get('CouponCode');
            }
            if(empty( Session::get('couponamount'))){
                $coupone_amount = "";
            }else {
                $coupone_amount = Session::get('couponamount');

            }

            $order = new Order;
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name = $shippingDetails->name;
            $order->address = $shippingDetails->address;
            $order->city = $shippingDetails->city;
            $order->state = $shippingDetails->state;
            $order->pinecode = $shippingDetails->pincode;
            $order->country = $shippingDetails->country;
            $order->mobile = $shippingDetails->mobile;
            $order->shipping_charges = $shippingDetails->name;
            $order->coupon_code =  $coupone_code;
            $order->coupon_amount = $coupone_amount;
            $order->order_status = "New";
            $order->payment_method = $data['payment_method'];
            $order->grand_total = $data['grand_total'];

            $order->save();

            $order_id = DB::getPdo()->lastInsertId();
            $cartProduct = DB::table('cart')->where(['user_email' => $user_email ])->get();
            foreach($cartProduct as $pro){
                 $cartPro = new  OrdersProduct;
                 $cartPro->order_id =  $order_id;
                 $cartPro->user_id = $user_id;
                 $cartPro->product_id = $pro->product_id;
                 $cartPro->product_code = $pro->product_code;
                 $cartPro->product_name = $pro->product_name;
                 $cartPro->product_size = $pro->size;
                 $cartPro->product_color = $pro->product_color ;
                 $cartPro->product_price = $pro->price;
                 $cartPro->product_qty = $pro->quantity;
                 $cartPro->save();
            }
            Session::put('order_id',$order_id);
            Session::put('grand_total',$data['grand_total']);
            if($data['payment_method'] == "COD"){
                // COD - redirect user to thanks page after saving order
                $productDetails = Order::with('orders')->where('id',$order_id)->first();
                $userDetails = User::where('id',$user_id)->first();

                // Code For Order Email Start 
                $email = $user_email;
                $messageData = [
                    'email' => $email,
                    'name' => $shippingDetails->name,
                    'order_id' => $order_id,
                    'productDetails' => $productDetails,
                    'userDetails' => $userDetails,
                    
                ];
                Mail::send('emails.order', $messageData, function($message) use($email){
                   $message->to($email)->subject('Order Place - E-com Website');
                });

                // Code For Order Email End 

                return redirect('/thanks');
            }else{
                // paypal - redirect user to Paypal page after saving order
                return redirect('/paypal'); 
            }

        }

    }

    public function thanks(Request $request){
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email', $user_email )->delete();

         return view('orders.thanks');
    }


    public function thanksPaypal(){
        return view('orders.thanks_paypal');

    }

    public function cancelPaypal(){
        return view('orders.cancel_paypal');

    }


    public function paypal(Request $request){
         $user_email = Auth::user()->email;
         DB::table('cart')->where('user_email', $user_email )->delete();
         return view('orders.paypal');
    }

    public function userOrders(){
        $user_id = Auth::user()->id;
        $orders = Order::with('orders')->where('user_id',$user_id)->orderBy('id','DESC')->get();
        return view('orders.user_orders')->with(compact('orders'));
    }

    public function userOrderDetails($order_id){
         $user_id = Auth::user()->id;
         $orderDetails = Order::with('orders')->where('id',$order_id)->first();
         return view('orders.user_order_details')->with(compact('orderDetails'));
    }

    public function viewOrders(){
        $orders = Order::with('orders')->orderBy('id','Desc')->get();
        return view('admin.orders.view_orders')->with(compact('orders'));
    }

    public function viewOrderDetails($order_id){
        $oderDetails = Order::with('orders')->where('id',$order_id)->first();
       /* $oderDetails = json_decode(json_encode($oderDetails));
        echo "<pre>";print_r($oderDetails);die;*/
        $user_id = $oderDetails->user_id;
        $userDetails = User::where('id',$user_id )->first();
        return view('admin.orders.order_details')->with(compact('oderDetails','userDetails'));
    }


    public function viewOrderInvoice($order_id){
        $oderDetails = Order::with('orders')->where('id',$order_id)->first();
       /* $oderDetails = json_decode(json_encode($oderDetails));
        echo "<pre>";print_r($oderDetails);die;*/
        $user_id = $oderDetails->user_id;
        $userDetails = User::where('id',$user_id )->first();
        return view('admin.orders.order_invoice')->with(compact('oderDetails','userDetails'));
    }


    public function updateOrderStatus(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
           // echo "<pre>";print_r($data);die;
           Order::where('id',$data['order_id'])->update(['order_status' => $data['order_status']]);
           return redirect()->back()->with('flash_message_Success','Order Status has been update Successfully');
        }

    }



}

