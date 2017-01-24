<?php

use Illuminate\Database\Seeder;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('infos')->insert([
            'name' => 'name',
            'label' => 'Nom',
            'type' => 'text',                        
        ]);

        
        DB::table('infos')->insert([
            'name' => 'email',
            'label' => 'Adresse E-Mail',
            'type' => 'email',                        
        ]);        

        DB::table('infos')->insert([
            'name' => 'address',
            'label' => 'Adresse',
            'type' => 'text',                        
        ]);

        DB::table('infos')->insert([
            'name' => 'cp',
            'label' => 'Code Postal',
            'type' => 'number',                        
        ]);

        DB::table('infos')->insert([
            'name' => 'city',
            'label' => 'Ville',
            'type' => 'text',                        
        ]);

        DB::table('infos')->insert([
            'name' => 'phone',
            'label' => 'Téléphone',
            'type' => 'phone',   
            'pattern' => '^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$'                     
        ]);

        DB::table('infos')->insert([
            'name' => 'mobile',
            'label' => 'Téléphone portable',
            'type' => 'phone',   
            'pattern' => '^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$'                     
        ]);
        
        DB::table('infos')->insert([
            'name' => 'gps',
            'label' => 'Coordonées GPS',
            'type' => 'text',   
            'pattern' => '^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?),\s*[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$'                     
        ]);

        DB::table('infos')->insert([
            'name' => 'keywords',
            'label' => 'Mots-clés',
            'type' => 'tags',                    
        ]);

        DB::table('infos')->insert([
            'name' => 'description',
            'label' => 'Déscription',
            'type' => 'text',                    
        ]);

        DB::table('infos')->insert([
            'name' => 'gapi',
            'label' => 'Clé API Google',
            'type' => 'text',                    
        ]);

        DB::table('infos')->insert([
            'name' => 'recaptchaP',
            'label' => 'Clé reCAPTCHA publique',
            'type' => 'text',                    
        ]);

        DB::table('infos')->insert([
            'name' => 'recaptchaS',
            'label' => 'Clé reCAPTCHA secrète',
            'type' => 'text',                    
        ]);

        
    }
}
