<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
