<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $warehouseId=$request->session()->get('filter_warehouse_id', null);
            $name=$request->session()->get('find_product',null);
            $quantity=$request->session()->get('find_quantity',null);
            $price=$request->session()->get('find_price',null);
            $orderBy=$request->session()->get('order_by', 'name');
            $dir=$request->session()->get('order_direction', 'ASC');
        /*
        if($warehouseId!=null){
            $products =  Product::where('warehouse_id',$warehouseId )->get();
        }else{
            $products =  Product::all();
        }
*/
        $products=Product::filter($warehouseId, $quantity, $price)->findByName($name)->orderBy($orderBy,$dir)->get();
        return view('products.index',['products'=>$products, 'warehouses'=>Warehouse::all(), 'filter_warehouse_id'=>$warehouseId, 'findProduct'=>$name, 'findQuantity'=>$quantity, 'orderBy'=>$orderBy, 'orderDirection'=>$dir]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouses= Warehouse::all();
        return view('products.edit', ['warehouses'=>$warehouses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required', 'min:3', 'max:20','alpha_num'],
            'quantity'=>['required'],
            'price'=>['required'],
        ],[
            'name.required'=>'Produkto pavadinimas privalomas',
            'name.min'=>'Produkto pavadinimas ne trumpesnis nei 3 simboliai',
            'name.max'=>'Produkto pavadinimas ne ilgesnis nei 20 simbolių',
            'quantity.required'=>'Kiekis privalomas',
            'price.required'=>'Kaina privaloma'
        ]);


        $product = new Product();
        $product->name = $request->name;
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->warehouse_id=$request->warehouse_id;
        $product->save();
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $warehouses=Warehouse::all();
        return view('products.edit',['product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>['required', 'min:3', 'max:20','alpha_num'],
            'quantity'=>['required'],
            'price'=>['required'],
        ],[
            'name.required'=>'Produkto pavadinimas privalomas',
            'name.min'=>'Produkto pavadinimas ne trumpesnis nei 3 simboliai',
            'name.max'=>'Produkto pavadinimas ne ilgesnis nei 20 simbolių',
            'quantity.required'=>'Kiekis privalomas',
            'price.required'=>'Kaina privaloma'
        ]);
        $product->name = $request->name;
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->warehouse_id=$request->warehouse_id;
        $product->save();
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back();
    }

    public function warehouseProducts($id){
        $products=Product::where('warehouse_id',$id)->get();
        $warehouses=Warehouse::all();
        return view('products.index',['products'=>$products, 'warehouses'=>$warehouses]);
    }

    public function filterProducts(Request $request){
        $request->session()->put('filter_warehouse_id',$request->warehouse_id);
        $warehouses=Warehouse::all();
       return redirect()->route('products.index');
    }

    public function findProducts(Request $request){
        $request->session()->put('find_product',$request->name);
        $request->session()->put('find_quantity',$request->quantity);
        return redirect()->route('products.index');
    }

  /*  public function findQuantity(Request $request){
        $request->session()->put('find_quantity',$request->quantity);
        return redirect()->route('products.index');
    }
  */
    public function orderProducts(Request $request, $field){
        if($request->session()->get('order_by')==$field){
           $dir = $request->session()->get('order_direction', 'ASC');
            if($dir=='ASC'){
                $request->session()->put('order_direction','DESC');
            }else{
                $request->session()->put('order_direction', 'ASC');
            }
            }else{
            $request->session()->put('order_direction', 'ASC');
        }
    $request->session()->put('order_by',$field);
    return redirect()->route('products.index');
    }
}
