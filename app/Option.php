<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 25/10/2017
 * Time: 00:47
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'poll_options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'poll_id',
        'name'
    ];

    public function survey(){
        return $this->belongsTo(Poll::class, 'poll_id');
    }
}