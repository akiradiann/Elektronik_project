<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Sorting
        $sortColumn = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        
        // Allowed columns to prevent SQL injection
        $allowedSorts = ['id', 'name', 'description', 'price', 'stock', 'created_at', 'updated_at'];
        if (!in_array($sortColumn, $allowedSorts)) {
            $sortColumn = 'created_at';
        }
        
        $query->orderBy($sortColumn, $sortOrder);

        $products = $query->paginate(5)->withQueryString();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ], [
            'required' => 'data tidak boleh kosong',
            'price.numeric' => 'Harga harus berupa angka dan bernilai positif',
            'price.min' => 'Harga harus berupa angka dan bernilai positif',
            'stock.numeric' => 'Stok harus berupa angka dan bernilai positif',
            'stock.integer' => 'Stok harus berupa angka dan bernilai positif',
            'stock.min' => 'Stok harus berupa angka dan bernilai positif',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ], [
            'required' => 'data tidak boleh kosong',
            'price.numeric' => 'Harga harus berupa angka dan bernilai positif',
            'price.min' => 'Harga harus berupa angka dan bernilai positif',
            'stock.numeric' => 'Stok harus berupa angka dan bernilai positif',
            'stock.integer' => 'Stok harus berupa angka dan bernilai positif',
            'stock.min' => 'Stok harus berupa angka dan bernilai positif',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Export to PDF.
     */
    public function exportPdf()
    {
        $products = Product::all();
        $pdf = Pdf::loadView('products.pdf', compact('products'));
        return $pdf->download('produk-elektronik.pdf');
    }

    /**
     * Export to Excel.
     */
    public function exportExcel()
    {
        return Excel::download(new ProductsExport, 'produk-elektronik.xlsx');
    }
}
