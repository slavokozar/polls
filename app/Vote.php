<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 25/10/2017
 * Time: 00:47
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'poll_votes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'poll_id',
        'option_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function poll()
    {
        return $this->belongsTo(Poll::class, 'survey_id');
    }

    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id');
    }
}