<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $fillable = ['student_number', 'first_name', 'last_name', 'section_id'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
