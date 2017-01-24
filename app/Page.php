<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public static function search($query)
    {
        $queries = explode(' ', $query);
        $dbQuery = \DB::table('pages')
                        ->join('categories', 'categories.id', '=', 'pages.category_id');

        foreach($queries as $q){
            $dbQuery = $dbQuery->select('pages.id', 'pages.title', 'pages.description','pages.name')
                                    ->orWhere('categories.name', 'LIKE', "%".$q."%")
                                    ->orWhere('pages.title', 'LIKE', "%".$q."%")
                                    ->orWhere('pages.content', 'LIKE', "%".$q."%")
                                    ->orWhere('pages.description', 'LIKE', "%".$q."%")
                                    ->orWhere('pages.tags', 'LIKE', "%".$q."%");
        }

        $dbQuery = $dbQuery->distinct()
                            ->get();
        $array = array();
        foreach($dbQuery as $item){

            $result = new \stdClass();
            $result->{'title'} =$item->title;
            $result->{'description'} = $item->description;
            $result->{'link'} = url('/page/'.$item->name);
            $array[] = $result;
        }

        return $array;

        
    }
}
