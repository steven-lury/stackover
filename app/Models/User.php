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
        'profile_photo_url', 'avatar'
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
        $questionVoting = $this->voteQuestions();
        $this->_voting($questionVoting, $question, $vote);

    }

    public function votingAnswer(Answer $answer, $vote)
    {

        $answerVoting = $this->voteAnswers();
        $this->_voting($answerVoting, $answer, $vote);

    }

    private function _voting($relationship, $model, $vote) :void
    {
        //check if the current user vote before or not
        if( $relationship->where('votable_id', $model->id)->exists() ){
            $relationship->updateExistingPivot($model, ['vote' => $vote]);
        }else{
            $relationship->attach($model, ['vote' => $vote]);
        }
        $model->load('votes');//load all models'vote by users
        $voteUp = (int) $model->votes()->wherePivot('vote', 1)->sum('vote');
        $voteDown = (int) $model->votes()->wherePivot('vote', -1)->sum('vote');
        $model->votes_count = $voteDown + $voteUp;
        $model->save();
    }
}
