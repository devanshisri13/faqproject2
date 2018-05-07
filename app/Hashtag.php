<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    use \Spatie\Tags\HasTags;


  //  protected $fillable = ['body'];

    public function question()
    {
        return $this->belongsTo('App\Question');
    }





}