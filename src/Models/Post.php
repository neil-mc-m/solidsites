<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 06/11/2017
 * Time: 22:10
 */

namespace Solidsites\Models;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}