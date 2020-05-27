<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['user_id', 'content', 'images'];

        public function user()
        {
            return $this->hasOne('App\User', 'id', 'user_id');
        }
        
    public static function blogPost(){
        return  Post::all();
    }
}
