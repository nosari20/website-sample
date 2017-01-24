<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function files(){
        return DB::table('files')
            ->join('file_rights', 'files.id', '=', 'file_rights.file_id')
            ->join('users', 'users.id', '=', 'file_rights.user_id')
            ->where('users.id', '=', $this->id)
            ->select('files.*')->distinct();
    }
}
