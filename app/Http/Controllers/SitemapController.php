<?php

namespace App\Http\Controllers;

use App\Page;

class SitemapController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //        
    }

    public function sitemap(){

        $data = new \stdClass();

        $pages = Page::all();
        
        foreach($pages as $page){
            $page->{'loc'} = 'page/'.$page->name;
            $page->{'lastmod'} = $page->updated_at->toAtomString();
        }


        /*
        $contact = new Page();
        $contact->{'loc'} = 'contact';
        $pages[] = $contact;
        */

        $data->{'urls'} = $pages;
        return response()->view('utils.sitemap', (array)$data)->header('Content-Type', 'text/xml');
    }
}