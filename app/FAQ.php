<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
   public $timestamps = false;
   
   protected $table = 'faqs';  

   public static function search($query)
    {
        $queries = explode(' ', $query);
        $dbQuery = \DB::table('faqs');

        foreach($queries as $q){
            $dbQuery = $dbQuery->select('id', 'question', 'answer')
                                    ->orWhere('question', 'LIKE', "%".$q."%")
                                    ->orWhere('answer', 'LIKE', "%".$q."%");
        }

        $dbQuery = $dbQuery->distinct()
                            ->get();
        $array = array();
        foreach($dbQuery as $item){

            $result = new \stdClass();
            $result->{'title'} =$item->question;
            $result->{'description'} =  (strlen(strip_tags($item->answer)) > 153) ? substr(strip_tags($item->answer),0,100).'...' : strip_tags($item->answer);            
            $result->{'link'} = url('/faq?question='.$item->id);
            $array[] = $result;
        }

        return $array;

        
    } 
   
}
