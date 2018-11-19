<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectPage extends Model
{
    protected $fillable = ['priority'];
    
    public function project () 
    {
        return $this->belongsTo(Project::class);
    }

}
