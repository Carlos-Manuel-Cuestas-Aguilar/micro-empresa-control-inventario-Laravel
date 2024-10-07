<?php

namespace App\Http\Controllers;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index() {
        return Proveedor::all();
    }

    public function store(Request $request) {
        $attributes = $request->validate(['nombre' => 'required']);
        return Proveedor::create($attributes);
    }

    public function show(Proveedor $proveedor) {
        return $proveedor;
    }

    public function update(Request $request, Proveedor $proveedor) {
        $attributes = $request->validate(['nombre' => 'required']);
        $proveedor->update($attributes);
        return $proveedor;
    }

    public function destroy(Proveedor $proveedor) {
        $proveedor->delete();
        return response()->json(null, 204);
    }
}
