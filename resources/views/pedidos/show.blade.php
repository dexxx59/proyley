@extends('layouts.app')
@section('title', 'Developers | Detalle de Pedido')
@section('body-class', 'product-page')
@section('content')

<div class="header header-filter">
</div>

<div class="main main-raised">
    <div class="container">        

        <div class="section text-center">
            <h2 class="title">Detalle del Pedido</h2>
                <hr>  
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Imagen</th>                              
                                <th class="text-center">Prenda</th>
                                <th class='text-center'>Cantidad</th>
                                <th class="text-center">Precio</th>
                                <th class="text-center">Subtotal</th>
                                <th class="text-center">Descuento</th>
                            </tr>
                        </thead>
                        <tbody>
                       @foreach ($detailPedido as $detail)
                        <tr>
                            <td class="text-center">
                               <img src="{{ $detail->prenda->featured_image_url }}" height="50px">
                            </td>
                            <td>{{ $detail->prenda->nombre }}</td>                            
                            <td>{{ $detail->cantidad }} </td>
                            <td class="text-right">$ {{ $detail->prenda->precioUnit }}</td>
                            <td class="text-right">${{ $detail->cantidad * $detail->prenda->precioUnit }} </td>
                            
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                        
                    <p class='text-right'><strong>Importe a pagar: </strong>${{ $total }}</p>

            <!--a class="btn btn-info" href="{{route("pedidos.index")}}">
                <i class="fa fa-arrow-left"></i>&nbsp;Volver
            </a-->
            <a class="btn btn-success" href="{{route("pedidos.ticket", ["id" => $venta->id])}}">
                <i class="fa fa-print"></i>&nbsp;Ticket
            </a>
                
        </div>
    </div>
</div>

@include('includes.footer')
@endsection