<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Show all products
    public function index()
    {
        $products = Product::all(); 
        return view('home', compact('products')); // Change to 'products' view
    }
    public function adminTable()
    {
        $products = Product::all();
        return view('admin.table', compact('products'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
    
        if (!$product) {
            return redirect()->route('admin.table')->with('error', 'Product not found.');
        }
    
        return view('admin.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
    
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'stock' => 'required|integer',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048' // Image validation
        ]);
    
        // Handle file upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($product->photo) {
                Storage::delete('public/' . $product->photo);
            }
    
            // Store new image
            $photoPath = $request->file('photo')->store('products', 'public');
            $product->photo = $photoPath;
        }
    
        // Update other fields
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->stock = $request->stock;
        
        $product->save();
    
        return redirect()->route('admin.table')->with('success', 'Product updated successfully!');
    }
    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.table')->with('success', 'Product deleted successfully!');
    }

    //store product
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'description' => 'nullable',
        'category' => 'required',
        'stock' => 'required|integer',
        'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('products', 'public');
    }

    Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        'category' => $request->category,
        'stock' => $request->stock,
        'photo' => $photoPath,
    ]);

    return redirect()->route('admin.table')->with('success', 'Product added successfully!');
}
public function create()
{
    return view('admin.create');  
}
}