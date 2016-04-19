<?php

namespace FurnitureShop\Http\Controllers;
use Illuminate\Http\Request;
use FurnitureShop\Http\Requests;
use FurnitureShop\Product;

class Products extends Controller
{
    
    protected $product;

    public function index($id = null) {
        if ($id == null) {
            return Product::orderBy('id', 'asc')->get();
        } else {
            return $this->show($id);
        }
    }

    public function store(Request $request) {
  
        $product = new Product;
        $this->getProduct($request,$product);
        $product = $this->product;
        $product->save();

        return "Producto creado existosamente!";
    }

    public function show($id) {
        return Product::find($id);
    }

   
    public function update(Request $request, $id) {
        
        $product = Product::find($id);
        $this->getProduct($request,$product);
        $product = $this->product;
        $product->save();

        return "Producto editado correctamente";
    }

    public function destroy(Request $request,$id) {
       
        $product = Product::find($id);
        $product->delete();
        return "Producto eliminado correctamente";
    }

    //Get the data to product by request
    public function getProduct(Request $request, $product){
        $product->name = $request['name'];
        $product->description = $request['description'];
        $product->stock = $request['stock'];
        $product->price = $request['price'];
        $product->trend = $request['trend']; 
        $product->model = $request['model'];
        $this->product = $product;
    }

 
} 