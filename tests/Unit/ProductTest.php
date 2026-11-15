<?php

namespace Tests\Unit;

use App\Models\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function test_product_exposes_only_expected_mass_assignable_fields(): void
    {
        $this->assertSame([
            'name', 'slug', 'sku', 'category', 'description',
            'price', 'compare_at_price', 'stock', 'image_url', 'is_active',
        ], (new Product())->getFillable());
    }
}
