<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatesOfBrazil extends Model
{
    protected $table = 'states_of_brazil';
    protected $fillable = ['id_orgin', 'name', 'uf'];

}
