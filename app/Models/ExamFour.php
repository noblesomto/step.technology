<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamFour extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'answer1','answer2','answer3','correct_answer'];
}
