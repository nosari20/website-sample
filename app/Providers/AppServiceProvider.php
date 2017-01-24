<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Info;
use App\Social;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Category;
use App\Page;
use App\Configuration;
use App\Partenaire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {



        Validator::extend('phone', function($attribute, $value, $parameters, $validator) {
            return preg_match('#^0[0-9]([ .-]?[0-9]{2}){4}$#', $value);
        });

        Validator::replacer('phone', function($message, $attribute, $rule, $parameters) {
            return 'Numéro de téléphone invalide';
        });

        //Creating global data
        $data = new \stdClass();

        
        //Setting path to assets directories
        $data->{'url'} = new \stdClass();        
        $assetUrl = app('url')->asset('/').'assets/';        
        $data->url->{'assets'} = $assetUrl;
        $data->url->{'img'} = $assetUrl."img/";
        $data->url->{'js'} = $assetUrl."javascript/";
        $data->url->{'css'} = $assetUrl."stylesheets/";  
        $data->url->{'font'} = $assetUrl."fonts/";  

        
        $data->url->{'upload'} = asset('/')."upload/";
        
        //Setting path to admin assets directories
        $data->{'adminUrl'} = new \stdClass();        
        $adminAssetUrl = app('url')->asset('/').'admin-assets/';        
        $data->adminUrl->{'assets'} = $adminAssetUrl;
        $data->adminUrl->{'img'} = $adminAssetUrl."img/";
        $data->adminUrl->{'js'} = $adminAssetUrl."javascripts/";
        $data->adminUrl->{'css'} = $adminAssetUrl."stylesheets/";  
        $data->adminUrl->{'font'} = $adminAssetUrl."fonts/";  
        $data->adminUrl->{'vendor'} = $adminAssetUrl."vendor/"; 
        
        //Global information

        $info=new \stdClass();
        try{
            $infoQuery = Info::all();
            foreach ($infoQuery as $value) {
                $info->{''.$value->name} = $value->value;
            }       
            $data->{'info'} = $info;  
        } catch (\Illuminate\Database\QueryException $e){}


        //Social information
        $social=new \stdClass();
        try{
            $socialQuery = Social::all();
            foreach ($socialQuery as $value) {
                $social->{''.$value->name} = $value;
            }       
            $data->{'social'} = $social;
        } catch (\Illuminate\Database\QueryException $e){}
        

        //User agent
        $ua = new Agent();
        $agent=new \stdClass();
        $agent->{'mobile'} = $ua->isMobile();
        $agent->{'phone'} = $ua->isPhone();
        $agent->{'tablet'} = $ua->isTablet();
        $agent->{'desktop'} = $ua->isDesktop();
        $data->{'agent'} = $agent;

        //Init user   
        $data->{'user'} = null;  



        $categories = new \stdClass();
        try{

            $cat = new Category();
            $cat->id = -1;
            $cat->{'pages'} = Page::where('category_id','=',-1)->get();
            $cat->{'dropdown'} = false;
            $categories->{"autres"} = $cat;

            $categoryQuery = Category::all();
            foreach ($categoryQuery as $value) {
                $value->{'pages'} = $value->pages()->get();
                $value->{'dropdown'} = true;
                $categories->{''.explode(" ",$value->name)[0]} = $value;
            }     
              
            $data->{'categories'} = $categories;
        } catch (\Illuminate\Database\QueryException $e){}



        // Tags
        $tags = "";
        try{
            $pages= Page::all();
            foreach ($pages as $page) {
                $tags = $tags.','.$page->tags;
            }       
            $data->{'tags'} = $tags;
        } catch (\Illuminate\Database\QueryException $e){}


        
        try{
            $data->{'partenaires'} = Partenaire::all();
        } catch (\Illuminate\Database\QueryException $e){}


       

        //Share data with all views
        view()->share((array)$data);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
