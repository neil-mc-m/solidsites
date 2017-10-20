<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 20/10/2017
 * Time: 23:17
 */

namespace Solidsites\Models;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    public function package()
    {
        return $this->belongsTo('Solidsites\Models\Package');
    }
}