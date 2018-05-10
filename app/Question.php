<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['body'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
    public function monthlyQuestions(View $view)
    {
        return  $view-> with ('mostlyQuestions',DB::table('questions')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get());
    }

}