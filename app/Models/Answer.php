<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\User;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id'];

    public function question(){

        return $this->belongsTo(Question::class);

    }

    public function user(){

        return $this->belongsTo(User::class);

    }

    public static function boot(){

        parent::boot();
        static::created(function($answer){
            $answer->question()->increment('answers_count');
        });

        static::deleted(function($answer){
            $answer->question()->decrement('answers_count');
        });

    }

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    public function getDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getAcceptedAttribute()
    {
        return $this->getIsBestAttribute() ? 'accepted' : '';
    }

    public function getIsBestAttribute()
    {
        return $this->id === $this->question->best_answer_id;
    }

    public function votes()
    {
        return $this->morphToMany(User::class, 'votable');
    }
}
