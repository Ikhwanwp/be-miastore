<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\ProductGallery;
use Illuminate\Support\Str; 
// Str -> fungsi helper dari laravel

class ProductController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Product::all();

        return view('pages.products.index')->with([
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        Product::create($data);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Product::findOrFail($id);

        return view('pages.products.edit')->with([
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $item = Product::findOrFail($id);
        $item->update($data);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Product::findOrFail($id);
        $item->delete();

        // Mengapus foto gallery jika produknya dihapus
        ProductGallery::where('products_id', $id)->delete();

        return redirect()->route('products.index');
    }

    public function gallery(Request $request, $id)
    {
        // untuk cek produknya ada apa engga
        $product = Product::findOrFail($id); 
        // Mengambil data produk, produk id diambil dari url id
        $items = ProductGallery::with('product')
            ->where('products_id', $id)
            ->get();

        return view('pages.products.gallery')->with([
            'product' => $product,
            'items' => $items
        ]);
    }
}
