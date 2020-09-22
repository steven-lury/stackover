<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body'];

    public function user(){

        return $this->belongsTo(User::class);
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
        }elseif($this->answers > 0){
            return 'answered';
        }
        return ' unaswered';
    }
}