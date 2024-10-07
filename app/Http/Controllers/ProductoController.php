<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index() {
        return Producto::with('proveedor')->get(); // Cargar proveedor
    }

    public function store(Request $request) {
        $attributes = $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'proveedor_id' => 'required|exists:proveedors,id'
        ]);
        return Producto::create($attributes)->load('proveedor');
    }

    public function show(Producto $producto) {
        return $producto->load('proveedor');
    }

    public function update(Request $request, Producto $producto) {
        $attributes = $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'proveedor_id' => 'required|exists:proveedors,id'
        ]);
        $producto->update($attributes);
        return $producto->load('proveedor');
    }

    public function destroy(Producto $producto) {
        $producto->delete();
        return response()->json(null, 204);
    }
}
