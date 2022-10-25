<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;
    //aula 223
    protected $fillable = ['tarefa','data_limite_conclusao','user_id'];
}
