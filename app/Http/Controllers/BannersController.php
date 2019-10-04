<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use App\Banner;
use Image;
class BannersController extends Controller
{
    public function addBanner(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $banner = new Banner;
            $banner->title  = $data['title'];
            $banner->description  = $data['description'];
            $banner->link  = $data['link'];
            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1;

            }
        
            //uploade Image
            if($request->hasFile('image')){
                $image_tmp  = Input::file('image');
                if($image_tmp->isValid()){
                    $extension  =  $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).".".$extension;
                    $banners_image_path = 'images/backend_images/banners/'.$filename;
                   // Resize Image Code
                   Image::make($image_tmp)->save($banners_image_path);
                   // Store image name in product table
                   $banner->image =  $filename ;
                }
            }


            $banner->status = $status ;
            $banner->save();
               return redirect('/admin/view-banners')->with('flash_message_Success','Banner has been  Added Successfuly!');
        
        }
        return view('admin.banners.add_banner');
    }

    public function viewBanners(){
        $banners = Banner::get();
        return view('admin.banners.view_banners')->with(compact('banners'));
    }

    public function editBanner(Request $request , $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['status'])){
                $status = 0;
            }
            else{
                $status = 1;
            }
            if(empty($data['title'])){
                $data['title'] = '';
            }
            if(empty($data['link'])){
                $data['link'] = '';
            }
            if(empty($data['description'])){
                $data['description'] = '';
            }
            //uploade Image
            if($request->hasFile('image')){
                $image_tmp  = Input::file('image');
                if($image_tmp->isValid()){
                    $extension  =  $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).".".$extension;
                    $banners_image_path = 'images/backend_images/banners/'.$filename;
                    // Resize Image Code
                    Image::make($image_tmp)->save($banners_image_path);
                } 
            }
            else if(!empty($data['current_image'])){
                $filename = $data['current_image'];
            }
            else{
                $filename  = '';
            }
             Banner::where('id',$id)->update(['status' => $status,  'title' => $data['title'] , 'link' => $data['link'], 'description' => $data['description'], 'image' =>  $filename]);
            return redirect()->back()->with('flash_message_Success','Banner  Has been update Successfuly');

        }
        $bannerDetaile = Banner::Where('id',$id)->first();
        return view('admin.banners.edit_banner')->with(compact('bannerDetaile'));
    }


    public function deleteBanner( $id = null){
        Banner::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_error','Banner Has Been deleted Successfuly!');

    }

}
