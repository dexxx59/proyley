<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function index()
    {
        $todosPedidos = Pedido::orderBy('fecha_reserva')->paginate(10);
        $PedidosPendientes = Pedido::where('estado', 'Pending')->orderBy('fecha_reserva')->paginate(10);
        $PedidosEnvio = Pedido::where('estado', 'Enviandose')->orderBy('fecha_reserva')->paginate(10);
        $PedidosEntregado = Pedido::where('estado', 'Entregado')->orderBy('fecha_reserva')->paginate(10);
        return view("admin.pedidos.index", ["ventas" => $todosPedidos, "pendientes" => $PedidosPendientes, "enEnvio" => $PedidosEnvio, "entregados" => $PedidosEntregado]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
        /*
        $venta = Pedido::find($id);

        $detailPedido = PedidoDetalle::where("pedido_id", $id)->get();
        return view('admin.pedidos.show')->with(compact('detailPedido', 'venta'));*/
    }

    public function edit(Pedido $venta)
    {
        //
    }

    public function update(Request $request, Pedido $venta)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}