<?php
// app/Models/Group.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    // Fillable fields for mass assignment
    protected $fillable = ['user_id', 'project_number'];

    // Disabling timestamps assuming there are no timestamp columns in the table
    public $timestamps = false;
}
