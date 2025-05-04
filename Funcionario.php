<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'funcionarios';
    protected $fillable = ['nome', 'departamento_id'];
    public $timestamps = false;

    public function departamento (){
        return $this->belongsTo(
        Departamento ::class, 'departamento_id' , 'id');
    }
};
