<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Question;
use App\Models\Answer;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers(){

        return $this->hasMany(Answer::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps();
    }

    public function getAvatarAttribute()
    {
        $email = $this->email;
        $size = 40;
        $siteUrl = "https://www.gravatar.com/avatar/";
        return $siteUrl.md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }

    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class, 'votable');
    }

    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class, 'votable');
    }

    public function votingQuestion(Question $question, $vote)
    {
        //check if the current user vote before or not, if so we have to update it
        if( $this->voteQuestions()->where('votable_id', $question->id)->exists() ){
            $this->voteQuestions()->updateExistingPivot($question, ['vote' => $vote]);
        }else{
            $this->voteQuestions()->attach($question, ['vote' => $vote]);
        }

        $question->load('votes');//load all questions'vote by users
        $voteUp = (int) $question->votes()->wherePivot('vote', 1)->sum('vote');
        $voteDown = (int) $question->votes()->wherePivot('vote', -1)->sum('vote');
        $question->vote = $voteUp + $voteDown;
        $question->save();

    }

    public function votingAnswer(Answer $answer, $vote)
    {
        //check if the current user vote before or not
        if( $this->voteAnswers()->where('votable_id', $answer->id)->exists() ){
            $this->voteAnswers()->updateExistingPivot($answer, ['vote' => $vote]);
        }else{
            $this->voteAnswers()->attach($answer, ['vote' => $vote]);
        }
        $answer->load('votes');//load all answers'vote by users
        $voteUp = (int) $answer->votes()->wherePivot('vote', 1)->sum('vote');
        $voteDown = (int) $answer->votes()->wherePivot('vote', -1)->sum('vote');
        $answer->votes_count = $voteDown + $voteUp;
        $answer->save();
    }
}
