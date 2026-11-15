<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StorefrontController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q', ''));

        $products = Product::query()
            ->where('is_active', true)
            ->when($search !== '', fn ($query) => $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            }))
            ->orderByDesc('created_at')
            ->select(['id', 'name', 'slug', 'category', 'price', 'compare_at_price', 'stock'])
            ->paginate(12)
            ->withQueryString();

        return view('store.index', compact('products', 'search'));
    }

    public function show(Product $product): View
    {
        abort_unless($product->is_active, 404);

        return view('store.show', compact('product'));
    }
}
