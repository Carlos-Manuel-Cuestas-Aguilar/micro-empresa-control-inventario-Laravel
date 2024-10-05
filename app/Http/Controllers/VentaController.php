<?php

namespace App\Http\Controllers;
use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index() {
        return Venta::with('detalles')->get(); // Cargar detalles
    }

    public function store(Request $request) {
        $request->validate(['fecha' => 'required|date']);
        
        $venta = Venta::create(['fecha' => $request->fecha, 'total' => 0]);
        $total = 0;

        foreach ($request->detalles as $detalle) {
            $subtotal = $detalle['cantidad'] * $detalle['precio'];
            $total += $subtotal;

            DetalleVenta::create([
                'venta_id' => $venta->id,
                'producto_id' => $detalle['producto_id'],
                'cantidad' => $detalle['cantidad'],
                'subtotal' => $subtotal,
            ]);
        }

        $venta->total = $total;
        $venta->save();

        return response()->json($venta, 201);
    }

    public function show($id) {
        return Venta::with('detalles')->findOrFail($id);
    }

    public function update(Request $request, $id) {
        // Similar al método de store, puedes implementar la lógica de actualización
    }

    public function destroy($id) {
        Venta::destroy($id);
        return response()->json(null, 204);
    }
}
