<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Everyday Carry Backpack', 'slug' => 'everyday-carry-backpack', 'sku' => 'BAG-001', 'category' => 'Accessories', 'description' => 'A clean, durable backpack designed for daily commutes and weekend escapes.', 'price' => 2499, 'compare_at_price' => 2999, 'stock' => 24],
            ['name' => 'Studio Wireless Headphones', 'slug' => 'studio-wireless-headphones', 'sku' => 'AUD-001', 'category' => 'Audio', 'description' => 'Comfort-first wireless headphones with balanced sound for work and travel.', 'price' => 3999, 'compare_at_price' => 4499, 'stock' => 18],
            ['name' => 'Minimal Ceramic Bottle', 'slug' => 'minimal-ceramic-bottle', 'sku' => 'HOME-001', 'category' => 'Home', 'description' => 'A reusable insulated bottle with a tactile matte finish.', 'price' => 899, 'compare_at_price' => null, 'stock' => 42],
            ['name' => 'Classic Everyday Watch', 'slug' => 'classic-everyday-watch', 'sku' => 'ACC-001', 'category' => 'Accessories', 'description' => 'A versatile everyday timepiece with a restrained, timeless design.', 'price' => 5299, 'compare_at_price' => 5999, 'stock' => 12],
            ['name' => 'Desk Mat — Graphite', 'slug' => 'desk-mat-graphite', 'sku' => 'WORK-001', 'category' => 'Workspace', 'description' => 'A smooth, easy-clean surface to bring order to your workspace.', 'price' => 1199, 'compare_at_price' => null, 'stock' => 31],
            ['name' => 'Portable Bluetooth Speaker', 'slug' => 'portable-bluetooth-speaker', 'sku' => 'AUD-002', 'category' => 'Audio', 'description' => 'Room-filling sound in a compact speaker made for moving around.', 'price' => 2799, 'compare_at_price' => 3299, 'stock' => 16],
            ['name' => 'Soft Knit Throw', 'slug' => 'soft-knit-throw', 'sku' => 'HOME-002', 'category' => 'Home', 'description' => 'A soft textured throw that adds warmth to a reading nook or sofa.', 'price' => 1899, 'compare_at_price' => null, 'stock' => 20],
            ['name' => 'Aluminium Laptop Stand', 'slug' => 'aluminium-laptop-stand', 'sku' => 'WORK-002', 'category' => 'Workspace', 'description' => 'A sturdy, adjustable stand to create a more comfortable desk setup.', 'price' => 1599, 'compare_at_price' => 1899, 'stock' => 27],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(['sku' => $product['sku']], $product);
        }
    }
}
