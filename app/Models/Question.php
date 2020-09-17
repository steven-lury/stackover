<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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
}
