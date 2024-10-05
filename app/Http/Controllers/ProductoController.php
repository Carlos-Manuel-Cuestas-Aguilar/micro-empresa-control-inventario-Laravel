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
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'proveedor_id' => 'required|exists:proveedores,id'
        ]);
        return Producto::create($request->all());
    }

    public function show($id) {
        return Producto::with('proveedor')->findOrFail($id);
    }

    public function update(Request $request, $id) {
        $producto = Producto::findOrFail($id);
        $producto->update($request->all());
        return $producto;
    }

    public function destroy($id) {
        Producto::destroy($id);
        return response()->json(null, 204);
    }
}
