<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = ['id'];
    // answersのデータを取得 //
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    // usersのデータを取得(belongsTo)
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
