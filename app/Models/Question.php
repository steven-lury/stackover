<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Answer;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body'];

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function answers(){

        return $this->hasMany(Answer::class);

    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();//we pass `favorites` table name bcz we don't follow the convention name `question_user`
    }

    public function setTitleAttribute( $value){

        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        if($this->best_answer_id > 0){
            return 'answered-accepted';
        }elseif($this->answers_count > 0){
            return 'answered';
        }
        return ' unaswered';
    }

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    public function getFavoriteCountAttribute()
    {
        return $this->favorites()->count();
    }

    public function getIsFavoriteAttribute()
    {
        return $this->favorites()->where('user_id', auth()->id())->count() > 0;
    }

}
