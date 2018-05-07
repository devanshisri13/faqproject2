<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Question extends Model
{
    protected $fillable = ['body'];
    use \Spatie\Tags\HasTags;
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
    public function tag()
    {
        $question = $this->attachTag();
        $question->attachTag('tag 1');

//adding multiple tags
        $question->attachTags(['tag 2', 'tag 3']);

//using an instance of \Spatie\Tags\Tag
        $question->attach(\Spatie\Tags\Tag::createOrFind('tag4'));
    }
}
