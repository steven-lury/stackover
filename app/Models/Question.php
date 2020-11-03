<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Answer;
use App\Traits\VotableTraits;

class Question extends Model
{
    use HasFactory;
    use VotableTraits;

    protected $fillable = ['title', 'body'];
    protected $appends = ['date', 'excerpt'];
    const EXCERPT = 260;

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function answers(){

        return $this->hasMany(Answer::class)->orderBy('votes_count', 'DESC');

    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();//we pass `favorites` table name bcz we don't follow the convention name `question_user`
    }

    public function setTitleAttribute( $value){

        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getDateAttribute()
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
        return $this->bodyHtml();
    }

    public function getFavoriteCountAttribute()
    {
        return $this->favorites()->count();
    }

    public function getIsFavoriteAttribute()
    {
        return $this->favorites()->where('user_id', auth()->id())->count() > 0;
    }

    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->bodyHtml()) , self::EXCERPT);
    }

    private function bodyHtml(){
        return clean(\Parsedown::instance()->text($this->body));
    }
}
