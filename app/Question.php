<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;
use Spatie\Tags\HasTags;


class Question extends Model
{
    protected $fillable = ['body'];
    use HasTags;
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

public static function boot()
{
    parent::boot();

    self::saving(function ($model) {

        // Set up a container for any hashtags that get parsed
        App::singleton('tagqueue', function() {
            return new \App\TagQueue;
        });
        self::saved( function($model) {
            $model->syncTags(app('tagqueue')->getTags());
        });


        $environment = Environment::createCommonMarkEnvironment();
        $environment->addInlineParser(new \App\Parsers\HashtagParser());
        $parser = new DocParser($environment);
        $htmlRenderer = new HtmlRenderer($environment);

        $text = $parser->parse($model->body);

        $model->html = $htmlRenderer->renderBlock($text);
    });
}
}