<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Request;
use App\File;
use App\FileRight;
use App\Traits\CaptchaTrait;
use Illuminate\Support\Facades\Auth;
use Validator;
use Mail;
use App\Info;
use App\FAQ;
use App\Page;
use App\Carousel;
use App\Skill;
use App\Domain;
use App\Home;


class HomeController extends Controller
{
    use CaptchaTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data = new \stdClass();
        $data->{'link'} = "home";

        return view('contents.home', (array)$data);
    }


    


    public function postContact()
    {

        $info=Info::where('name','=', 'recaptchaS')->first();
        
        if($this->captchaCheck($info->value) == false){
            return redirect()->back()
                ->withErrors(['Captcha erroné'])
                ->withInput();
        }
        
        $validator= Validator::make(Request::all(), [
                        'name' => 'required',
                        'email' => 'required|email',
                        'phone' => 'required|phone',
                        'message' => 'required',
                    ]);
        if ($validator->fails()) {
            return redirect('/contact')
                        ->withErrors($validator)
                        ->withInput();
        }

        Mail::send('emails.contact', ['contact' => Request::all()], function ($m) {

            $email = Info::where('name','=','email')->first();
            
            if($email->value != ''){
                $to_email = $email->value;
                $to_name = Info::where('name','=','name')->first()->value;
                $m->to($to_email, $to_name);
            }          

            $from_email = Request::input('email');
            $from_name = Request::input('name').((Request::input('company')=='') ? '' : ' ('.Request::input('company').')');

            $m->from($from_email, $from_name)->subject('Contact via le site');
        });

        
        return redirect('/contact')->with('success', ['Message envoyé. Merci d\'avoir pris contact avec nous.']);


    }

    

    public function getPageByName($name)
    {
        $data = new \stdClass();

        $page = Page::where('name','=',$name)->first();

        if(!$page){
            return abort(404);
        }

        $data->{'page'} = $page;
        if($page->category_id!=-1){
            $data->{'link'} = 'page-'.$page->category_id;
        }else{
            $data->{'link'} = 'page-'.$page->name;
        }
        

        return view('contents.page', (array)$data);
    }    

    public function search()
    {
        $data = new \stdClass();
        $query = Request::input('query');
        $pages = Page::search($query);
        $faqs = FAQ::search($query);

        $data->{'results'} = array_merge($pages,$faqs);
        $data->{'query'} = $query;

        return view('contents.search', (array)$data);
    }
}
