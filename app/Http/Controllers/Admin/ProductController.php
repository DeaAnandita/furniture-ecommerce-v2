<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Material;
use App\Models\Style;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Product list
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'material', 'style']);

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {

            $query->where('name', 'like', '%' . $request->search . '%');

        }

        /*
        |--------------------------------------------------------------------------
        | FILTER CATEGORY
        |--------------------------------------------------------------------------
        */
        if ($request->filled('category')) {

            $query->where('category_id', $request->category);

        }

        /*
        |--------------------------------------------------------------------------
        | SORTING
        |--------------------------------------------------------------------------
        */
        $sort = $request->sort;
        $direction = $request->direction ?? 'asc';

        switch ($sort) {

            case 'name':
                $query->orderBy('name', $direction);
                break;

            case 'price':
                $query->orderBy('price', $direction);
                break;

            case 'stock':
                $query->orderBy('stock', $direction);
                break;

            case 'category':
                $query->join('categories', 'products.category_id', '=', 'categories.id')
                    ->orderBy('categories.name', $direction)
                    ->select('products.*');
                break;

            case 'material':
                $query->join('materials', 'products.material_id', '=', 'materials.id')
                    ->orderBy('materials.name', $direction)
                    ->select('products.*');
                break;

            case 'style':
                $query->join('styles', 'products.style_id', '=', 'styles.id')
                    ->orderBy('styles.name', $direction)
                    ->select('products.*');
                break;

            case 'latest':
                $query->latest();
                break;

            case 'low':
                $query->orderBy('price', 'asc');
                break;

            case 'high':
                $query->orderBy('price', 'desc');
                break;

            default:
                $query->latest();
                break;
        }

        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */
        $products = $query->paginate(5)->withQueryString();

        $categories = Category::all();
        $materials = Material::all();
        $styles = Style::all();

        return view('admin.products.index', compact(
            'products',
            'categories',
            'materials',
            'styles'
        ));
    }

    /**
     * Create page
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
            'category_id' => 'nullable',
            'material_id' => 'nullable',
            'style_id' => 'nullable',
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

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::all();
        $materials = Material::all();
        $styles = Style::all();

        return view('admin.products.edit', compact(
            'product',
            'categories',
            'materials',
            'styles'
        ));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required',
            'material_id' => 'required',
            'style_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $imageName = $product->image;

        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(
                public_path('produk'),
                $imageName
            );
        }

        $product->update([
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
            ->with('success', 'Produk berhasil diupdate');
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect('/admin/products')
            ->with('success', 'Produk berhasil dihapus');
    }
}