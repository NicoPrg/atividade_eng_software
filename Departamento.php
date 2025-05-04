<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamentos';
    protected $fillable = ['nome'];
    public $timestamps = false;

    public function funcionarios(){
        return $this->hasMany(
        Funcionario::class, // qual o modelo referenciado
        'departamento_id' , // chave estrangeira
        'id' // chave primária
        );
       }
}
