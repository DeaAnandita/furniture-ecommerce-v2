<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Material;
use App\Models\Style;

class ProductController extends Controller
{
    /**
     * Homepage
     */
    public function index(Request $request)
    {
        $query = Product::with([
            'category',
            'material',
            'style'
        ]);

        /**
         * Filter category
         */
        if ($request->category) {

            $query->where('category_id', $request->category);

        }

        $products = $query->latest()->get();

        /**
         * Category list
         */
        $categories = Category::all();

        return view('products.index', compact(
            'products',
            'categories'
        ));
    }

    /**
     * All products
     */
    public function all(Request $request)
    {
        $query = Product::with([
            'category',
            'material',
            'style'
        ]);

        /**
         * Search
         */
        if ($request->search) {

            $query->where('name', 'like', '%' . $request->search . '%');

        }

        /**
         * Category filter
         */
        if ($request->category) {

            $query->where('category_id', $request->category);

        }

        /**
         * Sorting
         */
        if ($request->sort == 'low') {

            $query->orderBy('price', 'asc');

        } elseif ($request->sort == 'high') {

            $query->orderBy('price', 'desc');

        } else {

            $query->latest();

        }

        $products = $query->paginate(12);

        /**
         * Category list
         */
        $categories = Category::all();

        return view('products.all', compact(
            'products',
            'categories'
        ));
    }

    /**
     * Detail product
     */
    public function show($id)
    {
        $product = Product::with([
            'category',
            'material',
            'style'
        ])->findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * Admin product page
     */
    public function admin()
    {
        $products = Product::with([
            'category',
            'material',
            'style'
        ])->latest()->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Create form
     */
    public function create()
    {
        $categories = Category::all();
        $materials = Material::all();
        $styles = Style::all();

        return view('admin.products.create', compact(
            'categories',
            'materials',
            'styles'
        ));
    }

    /**
     * Store product
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',

            'description' => 'required',

            'price' => 'required|numeric',

            'stock' => 'required|numeric',

            'category_id' => 'nullable|exists:categories,id',

            'material_id' => 'nullable|exists:materials,id',

            'style_id' => 'nullable|exists:styles,id',

            'image' => 'required|image|mimes:jpg,jpeg,png'

        ]);

        $imageName = null;

        /**
         * Upload image
         */
        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(
                public_path('produk'),
                $imageName
            );

        }

        /**
         * Save product
         */
        Product::create([

            'name' => $request->name,

            'description' => $request->description,

            'price' => $request->price,

            'stock' => $request->stock,

            'category_id' => $request->category_id,

            'material_id' => $request->material_id,

            'style_id' => $request->style_id,

            'image' => $imageName

        ]);

        return redirect('/admin/products')
            ->with('success', 'Produk berhasil ditambahkan');
    }
}