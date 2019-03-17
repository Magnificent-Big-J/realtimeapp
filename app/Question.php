<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title','body','slug','category_id','user_id'];
    protected $with = ['replies'];
    protected static function boot() {
        parent::boot();

        static::creating(function($question){
           $question->slug = str_slug($question->title);
        });
    }
    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
    public function replies() {
        return $this->hasMany(Reply::class)->latest();
    }
    public function category() {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getPathAttribute() {
        return "/question/$this->slug";
    }
}
