<?php

namespace Solidsites\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';
    protected $primaryKey = 'id';
    public function feature()
    {
        return $this->hasOne('Solidsites\Models\Feature');
    }
}
