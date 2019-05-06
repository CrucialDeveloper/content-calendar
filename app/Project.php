<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['owner', 'title', 'type', 'business_unit', 'publish_date'];

    protected $dates = ['publish_date'];
}
