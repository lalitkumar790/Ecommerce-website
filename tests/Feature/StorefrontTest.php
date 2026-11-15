<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StorefrontTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_lists_active_products_only(): void
    {
        Product::create([
            'name' => 'Test Backpack', 'slug' => 'test-backpack', 'sku' => 'TEST-001',
            'category' => 'Accessories', 'description' => 'A test product.',
            'price' => 1200, 'stock' => 5, 'is_active' => true,
        ]);

        Product::create([
            'name' => 'Hidden Product', 'slug' => 'hidden-product', 'sku' => 'TEST-002',
            'category' => 'Accessories', 'description' => 'Not visible.',
            'price' => 900, 'stock' => 5, 'is_active' => false,
        ]);

        $this->get(route('store.index'))
            ->assertOk()
            ->assertSee('Test Backpack')
            ->assertDontSee('Hidden Product');
    }

    public function test_customer_can_add_product_to_session_cart(): void
    {
        $product = Product::create([
            'name' => 'Test Bottle', 'slug' => 'test-bottle', 'sku' => 'TEST-003',
            'category' => 'Home', 'description' => 'A test bottle.',
            'price' => 500, 'stock' => 3, 'is_active' => true,
        ]);

        $this->post(route('cart.add', $product), ['quantity' => 2])
            ->assertRedirect(route('cart.index'))
            ->assertSessionHas("cart.{$product->id}", 2);

        $this->get(route('cart.index'))
            ->assertOk()
            ->assertSee('Test Bottle')
            ->assertSee('1,000.00');
    }

    public function test_cart_quantity_is_capped_at_available_stock(): void
    {
        $product = Product::create([
            'name' => 'Limited Item', 'slug' => 'limited-item', 'sku' => 'TEST-004',
            'category' => 'Home', 'description' => 'Only one left.',
            'price' => 100, 'stock' => 1, 'is_active' => true,
        ]);

        $this->post(route('cart.add', $product), ['quantity' => 1])
            ->assertRedirect(route('cart.index'));

        $this->post(route('cart.add', $product), ['quantity' => 1])
            ->assertRedirect(route('cart.index'))
            ->assertSessionHas("cart.{$product->id}", 1);
    }
}
