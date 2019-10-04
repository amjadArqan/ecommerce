<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\CmsPage;
use App\Category;
class CmsController extends Controller
{
    public function addCmsPage(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $CmsPage = new CmsPage;
            $CmsPage->title = $data['title'];
            $CmsPage->url = $data['url'];
            $CmsPage->description = $data['description'];
            if(empty($data['status'])){
                  $status = 0;
            }else{
                $status = 1;

            }
            $CmsPage->status =  $status ;
            $CmsPage->save();
            return redirect()->back()->with('flash_message_Success','CMS Page has been added successfully!');

        }
        return view('admin.pages.add_cms_page');
    }

    public function editCmsPage(Request $request,$id){
        $CmsPage = CmsPage::where('id',$id)->first();
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['status'])){
                    $status = 0;
            }else{
                $status = 1;

            }
            CmsPage::where('id',$id)->update(['title' => $data['title'], 'url' => $data['url'], 'description' => $data['description'], 'status' => $status]);

            return redirect()->back()->with('flash_message_Success','CMS Page has been Update successfully!');

        }
        return view('admin.pages.edit_cms_page')->with(compact('CmsPage'));
    }

    public function viewCmsPages(){
        $cmsPages = CmsPage::get();
        return view('admin.pages.view_cms_pages')->with(compact('cmsPages'));
        

    }

    public function deleteCmsPage(Request $request,$id){
        $CmsPage = CmsPage::where('id',$id)->delete();
        return redirect('/admin/view-cms-pages')->with('flash_message_Success','CMS Page has been deleted successfully!');

    }

    public function cmsPage($url){
        // Redirect to 404 if CMS Page is disabled or does not exists
        $cmspagecount = CmsPage::where(['url' => $url, 'status' => 1 ])->count();
        if($cmspagecount > 0){
            //Get CMS Page Details
            $cmsPageDetails  = CmsPage::where('url',$url)->first();
        }else{
            abort(404);
        }
        // Get All Categories and subCategories
        $categories = Category::where(['parent_id' => 0])->get();
        return view('pages.cms_page')->with(compact('cmsPageDetails','categories'));

    }

    public function contact(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo"<pre>";print_r($data);die;

            $email  = "1999.malik.jouda@gamil.com";
            $messageData  = [
                'name' =>$data['name'],
                'email' => $data['email'],
                'subject' => $data['subject'],
                'comment' => $data['message']
            ];
            Mail::send('emails.enquiry',$messageData,function($message) use($email){
                $message->to($email)->subject('Enquiry From Defacto Website');
            });
            
            return redirect()->back()->with('flash_message_Success','Thanks for your enquiry. We Will get Back to you soon!');

        }
        $categories = Category::where(['parent_id' => 0])->get();

        return view('pages.contact')->with(compact('categories'));;
    }
}
