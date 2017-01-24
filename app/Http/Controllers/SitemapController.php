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


        $contact = new Page();
        $contact->{'loc'} = 'contact';
        $pages[] = $contact;

        $leg = new Page();
        $leg->{'loc'} = 'informations-legales';
        $leg->{'priority'} = '0.2000';
        $pages[] = $leg;

        $cli = new Page();
        $cli->{'loc'} = 'espace-client';
        $pages[] = $cli;

        $data->{'urls'} = $pages;
        //return view('utils.sitemap', (array)$data);
        return response()->view('utils.sitemap', (array)$data)->header('Content-Type', 'text/xml');
    }
}