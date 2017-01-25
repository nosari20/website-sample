<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Request;

use App\Info;
use App\Social;
use App\Daily;
use App\User;
use App\Page;
use App\Category;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Creating global data
        /*
        $data = new \stdClass();
        view()->share((array)$data);  
        */      
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = new \stdClass();
        
        return view('auth.contents.home', (array)$data);
    }


    public function mail()
    {
        $data = new \stdClass();
        
        return view('auth.contents.email', (array)$data);
    }


    /**
     * Informations
     */
    public function getInfo()
    {
        $data = new \stdClass();

        $data->{'infos'} = Info::orderBy('id')->get();


        return view('auth.contents.info',(array)$data);
    }
    public function postInfo()
    {
       $input = Request::all();

    


       foreach ($input as $key => $value) {
           if($key!="_token"){
                 if(preg_match("/^social-.*$/", $key)){
                    $info=Social::where('name','=', str_replace("social-", "", $key))->first();
                    $info->value=$value;
                    $info->save();
                }else{
                    $info=Info::where('name','=', $key)->first();
                    $info->value=$value;
                    $info->save();
                }
                
                
           }   

       }

        return redirect('/admin/info');
    }

   

    /**
     * Daily messages
     */
    public function postDaily()
    {
        $text=Request::input('daily');
        $daily=new Daily();
        $daily->text=$text;
        $daily->save();
        return redirect('/admin');
    }

    /**
     * Espace client
     */
    public function getClientForm(){
        return view('auth.contents.client.register');
    }
    public function getClient(){
        $data = new \stdClass();

        $data->{'users'} = User::where('role','=','user')->get();


        return view('auth.contents.client.list',(array)$data);
    }
    public function getClientById($id){
        $data = new \stdClass();
        $user = User::find($id);
        if(!$user){
            return redirect('/admin/client');
        }
        $data->{'client'} = $user;
        $data->{'files'} = $user->files()->get();
        
        return view('auth.contents.client.details',(array)$data);
    }


    //File
    public function uploadFile(){
        $destinationPath = public_path()."/upload";
        $transliterator = \Transliterator::createFromRules(':: Any-Latin; :: NFD; :: [:Nonspacing Mark:] Remove; :: Lower(); :: NFC;', \Transliterator::FORWARD);
        $files = array();
        if (Request::hasFile('file')){



            foreach(Request::file("file") as $fileInput) {

 
                $fileUploaded = $fileInput;
                
                $fileName = urlencode(str_replace(array(' ','/','\\',')','(','\''), '', $transliterator->transliterate(uniqid().$fileUploaded->getClientOriginalName())));

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $fileUploaded->move($destinationPath, $fileName);



                $file = new File();
                $file->name = $fileUploaded->getClientOriginalName();
                $file->type = strtolower($fileUploaded->getClientOriginalExtension());
                $file->file = $fileName;
                $file->save();
                $files[] = $file;

                
            

                
                
            }

            if(Request::has('user')){
                $user = User::find(Request::input('user'));
                if($user){
                    foreach($files as $file){
                        $fileRight = new FileRight();
                        $fileRight->user_id = $user->id;
                        $fileRight->file_id = $file->id;
                        $fileRight->save();

                        $file->{'user'} = $user->id;
                    }

                }
            
            }
        }
        return response(json_encode($files), 200)
                  ->header('Content-Type', 'application/json');
        
    }

    public function deleteFile(){
        FileRight::where('user_id',"=",Request::input('user'))->where('file_id',"=",Request::input('file'))->delete();
        return response(json_encode(null), 200)
                  ->header('Content-Type', 'application/json');
    }

    public function grantFile(){
        

        $file = File::find(Request::input('file'));

        if($file){
            $user = User::find(Request::input('user'));

            if($user){
                $fileRight = new FileRight();
                $fileRight->user_id = $user->id;
                $fileRight->file_id = $file->id;
                $fileRight->save();

                return response(json_encode($file), 200)
                  ->header('Content-Type', 'application/json');
            }

            return response('User not Found.', 404);

        }

        return response('File not Found.', 404);
    }

    public function searchFile($query){
        

        $files = File::where("name","LIKE","%".$query."%")->take(10)->get();;

        return response(json_encode($files), 200)
                  ->header('Content-Type', 'application/json');
    }



    /**
     * Pages
     */

    public function getHome(){

        $data = new \stdClass();

        return view('auth.contents.pages.homepage',(array)$data);
    }
    
    public function getPages(){
        $data = new \stdClass();


        $categories = Category::all();

        $data->{'categories'} = $categories;

        $data->{'pages'} = new \stdClass();
        $data->pages->{'other'} = Page::where('category_id','=',-1)->get();
        foreach($categories as $category){
            $data->pages->{$category->id} = Page::where('category_id','=',$category->id)->get();
        }


        return view('auth.contents.pages.list',(array)$data);
    }

    public function getPageById($id=null){
        $data = new \stdClass();

        if($id == null){
            $page = new Page();
            $page->name = "nouvelle-page";
            $page->title = "Nouvelle page";
            $page->category_id = -1;
            $page->id = -1;
        }else{
            $page = Page::find($id);
            if($page == null){
                return abort(404);
            }
        }

        
        
        $data->{'page'} = $page;

        $data->{'categories'} = Category::all();

        return view('auth.contents.pages.details',(array)$data);
    }

    

    public function postPageById($id=null){
        if($id==null){
            $page = new Page();
        }else{
            $page = Page::find($id);
        }
        
        if($page == null){
            return abort(404);
        }

        $transliterator = \Transliterator::createFromRules(':: Any-Latin; :: NFD; :: [:Nonspacing Mark:] Remove; :: Lower(); :: NFC;', \Transliterator::FORWARD);

        $page->title = Request::input('title');        
        $page->name = urlencode(str_replace(array(' ','/','\\',')','(','\''),'-',str_replace(' ', '-', $transliterator->transliterate(Request::input('title')))));
        //$page->name =Request::input('title');
        $page->description = Request::input('description');
        $page->tags = Request::input('tags');
        $page->category_id = Request::input('category');
        $page->content = Request::input('content-desktop');
        if($page->content_tab == ""){
            $page->content_tab = Request::input('content-desktop');
        }else{
            $page->content_tab = Request::input('content-tab');
        }

         if($page->content_mobile == ""){
            $page->content_mobile = Request::input('content-desktop');
        }else{
            $page->content_mobile = Request::input('content-mobile');
        }
        
        $page->menu = (Request::input('menu')? 1 : 0);
        $page->save();

        return redirect('/admin/page/'.$page->id);
    }

    public function deletePageById($id=null){
        if($id!=null)
        $page = Page::find($id)->delete();
        return redirect('/admin/pages');
    }



}
