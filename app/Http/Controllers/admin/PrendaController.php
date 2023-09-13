<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Color;
use App\Models\Marca;
use App\Models\PedidoDetalle;
use App\Models\Prenda;
use App\Models\PrendaImage;
use App\Models\Talla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PrendaController extends Controller
{
    private $validar = [
        'nombre' => 'required',
        'stock' => 'required | numeric | min:5',
        'precioUnit' => 'required',
        'color_id' => 'required',
        'talla_id' => 'required',
        'marca_id' => 'required',
        'categoria_id' => 'required',
    ];
    private $validarEdit = [
        'nombre' => 'required',
        'stock' => 'required | numeric | min:5',
        'precioUnit' => 'required',
        'color_id' => 'nullable',
        'talla_id' => 'nullable',
        'marca_id' => 'nullable',
        'categoria_id' => 'nullable',
    ];

    public function index(Request $res){
   	    $prendas = Prenda::paginate(10);
        return view('admin.products.index')->with(compact('prendas'));
    }

    public function create(){
        $marcas = Marca::all();
        $colors = Color::all();
        $tallas = Talla::all();
        $categories = Categoria::orderBy('nombre')->get();
        return view('admin.products.create')->with(compact('categories', 'marcas', 'colors', 'tallas'));
    }

    public function store(Request $request){

        $request->validate($this->validar);

        $prenda = new Prenda();
        $prenda->categoria_id = $request->categoria_id;
        $prenda->marca_id = $request->marca_id;
        $prenda->color_id = $request->color_id;
        $prenda->talla_id = $request->talla_id;
        $prenda->nombre = $request->nombre;
        $prenda->stock = $request->stock;
        $prenda->precioUnit = $request->precioUnit;
        $prenda->description = $request->description;
        $prenda->save();
        return redirect('admin/products');
    }

    public function edit($id){
        
        $categories = Categoria::orderBy('nombre')->get();
        $marcas = marca::all();
        $colors = Color::all();
        $tallas = talla::all();
        $prendaEdit = prenda::find($id);
        return view('admin.products.edit')->with(compact('prendaEdit', 'categories', 'marcas', 'colors', 'tallas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->validarEdit);
        $prenda = prenda::find($id);
        $prenda->categoria_id = $request->categoria_id;
        $prenda->marca_id = $request->marca_id;
        $prenda->color_id = $request->color_id;
        $prenda->talla_id = $request->talla_id;
        $prenda->nombre = $request->nombre;
        $prenda->stock = $request->stock;
        $prenda->precioUnit = $request->precioUnit;
        $prenda->description = $request->description;
        $prenda->save();
        return redirect()->route('admin/products');
    }

    public function destroy($id)  
   {
      PedidoDetalle::where('prenda_id', $id)->delete();
      PrendaImage::where('prenda_id', $id)->delete();
   		$product = Prenda::find($id);
   		$product->delete();
   		
      Session::flash('msg', 'Se eliminó el producto y las imágenes asociadas');
   		return back();
   }
    
}
