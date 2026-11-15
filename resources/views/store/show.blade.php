@extends('layouts.store')
@section('title', $product->name)
@section('meta_description', $product->description)
@section('content')
<section class="mx-auto grid max-w-7xl gap-10 px-5 py-12 md:grid-cols-2 md:gap-16 md:py-20">
    <div class="relative aspect-[4/5] overflow-hidden rounded-2xl bg-gradient-to-br from-stone-200 via-stone-100 to-amber-100"><div class="absolute inset-0 flex items-center justify-center text-9xl font-serif text-stone-400/70">{{ mb_substr($product->name, 0, 1) }}</div></div>
    <div class="flex flex-col justify-center"><a href="{{ route('store.index') }}" class="mb-10 text-sm text-stone-500 hover:text-stone-900">← Back to collection</a><p class="text-xs font-semibold uppercase tracking-[.2em] text-amber-800">{{ $product->category }}</p><h1 class="mt-3 text-4xl font-semibold leading-tight tracking-tight sm:text-5xl">{{ $product->name }}</h1><div class="mt-5 flex items-center gap-3"><span class="text-2xl font-semibold">₹{{ number_format((float) $product->price, 2) }}</span>@if ($product->compare_at_price)<span class="text-sm text-stone-400 line-through">₹{{ number_format((float) $product->compare_at_price, 2) }}</span>@endif</div><p class="mt-7 max-w-lg leading-7 text-stone-600">{{ $product->description }}</p><p class="mt-6 text-sm {{ $product->stock > 0 ? 'text-emerald-700' : 'text-red-700' }}">{{ $product->stock > 0 ? $product->stock.' available' : 'Currently out of stock' }}</p>
    @if ($product->stock > 0)<form method="POST" action="{{ route('cart.add', $product) }}" class="mt-7 flex max-w-md gap-3">@csrf<label class="sr-only" for="quantity">Quantity</label><input id="quantity" name="quantity" type="number" min="1" max="{{ min(10, $product->stock) }}" value="1" class="w-24 rounded-full border border-stone-300 bg-white px-4 py-3 text-sm"><button class="flex-1 rounded-full bg-stone-900 px-6 py-3 text-sm font-semibold text-white hover:bg-amber-800">Add to bag</button></form>@endif
    <div class="mt-10 border-t border-stone-200 pt-6 text-xs leading-6 text-stone-500">Secure checkout will be added as a separate milestone. No payment details are collected on this demo storefront.</div></div>
</section>
@endsection
