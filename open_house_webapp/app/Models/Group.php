<?php

// app/Models/Groups.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['user_id', 'project_number'];
    public $timestamps = false; // Assuming no timestamps in the table
}

