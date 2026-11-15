<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $cart = $request->session()->get('cart', []);
        $products = Product::query()
            ->whereIn('id', array_keys($cart))
            ->where('is_active', true)
            ->get()
            ->keyBy('id');

        $items = collect($cart)->map(function (int $quantity, string|int $id) use ($products) {
            $product = $products->get($id);

            return $product ? ['product' => $product, 'quantity' => $quantity] : null;
        })->filter();

        $subtotal = $items->sum(fn (array $item) => (float) $item['product']->price * $item['quantity']);

        return view('cart.index', compact('items', 'subtotal'));
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        abort_unless($product->is_active, 404);

        $validated = $request->validate([
            'quantity' => ['sometimes', 'integer', 'min:1', 'max:10'],
        ]);

        if ($product->stock < 1) {
            return back()->withErrors(['quantity' => 'This product is currently out of stock.']);
        }

        $cart = $request->session()->get('cart', []);
        $current = (int) ($cart[$product->id] ?? 0);
        $requested = (int) ($validated['quantity'] ?? 1);
        $cart[$product->id] = min($current + $requested, $product->stock, 10);

        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('status', 'Added to your cart.');
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:10'],
        ]);

        abort_unless($product->is_active, 404);

        if ($validated['quantity'] > $product->stock) {
            return back()->withErrors(['quantity' => 'The requested quantity exceeds available stock.']);
        }

        $cart = $request->session()->get('cart', []);
        if (array_key_exists($product->id, $cart)) {
            $cart[$product->id] = $validated['quantity'];
            $request->session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('status', 'Cart updated.');
    }

    public function remove(Request $request, Product $product): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$product->id]);
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('status', 'Item removed.');
    }
}
