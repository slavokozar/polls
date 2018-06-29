<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 25/10/2017
 * Time: 00:47
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $table = 'polls';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'code',
        'name',
        'description',
        'public',
        'single_option'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function options(){
        return $this->hasMany(Option::class, 'poll_id');
    }

    public function votes(){
        return $this->hasMany(Vote::class, 'poll_id');
    }
}