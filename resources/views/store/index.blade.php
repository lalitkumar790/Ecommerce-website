@extends('layouts.store')
@section('title', 'Everyday essentials')
@section('meta_description', 'Explore thoughtful essentials for your home, workspace and everyday carry.')
@section('content')
<section class="mx-auto max-w-7xl px-5 pt-12 pb-10 md:pt-20">
    <div class="grid gap-8 md:grid-cols-[1.2fr_.8fr] md:items-end">
        <div><p class="mb-4 text-xs font-semibold uppercase tracking-[.22em] text-amber-800">The considered collection</p><h1 class="max-w-3xl text-4xl font-semibold leading-[1.08] tracking-tight sm:text-6xl">Better things for <span class="font-serif font-normal italic text-amber-800">everyday</span> living.</h1><p class="mt-5 max-w-xl text-base leading-7 text-stone-600">Useful objects. Thoughtful details. A little more intention in the things you bring home.</p></div>
        <form method="GET" action="{{ route('store.index') }}" class="flex gap-2"><label class="sr-only" for="product-search">Search products</label><input id="product-search" name="q" value="{{ $search }}" placeholder="Search the collection..." class="min-w-0 flex-1 rounded-full border border-stone-300 bg-white px-5 py-3 text-sm outline-none focus:border-amber-700"><button class="rounded-full bg-stone-900 px-6 py-3 text-sm font-medium text-white hover:bg-amber-800">Search</button></form>
    </div>
    <div class="mt-12 flex items-end justify-between border-b border-stone-200 pb-4"><div><p class="text-xs uppercase tracking-[.18em] text-stone-500">Curated for you</p><h2 class="mt-1 text-2xl font-semibold tracking-tight">The collection</h2></div><p class="text-sm text-stone-500">{{ $products->total() }} products</p></div>
    @if ($products->isEmpty())
        <div class="py-20 text-center"><p class="text-lg font-medium">Nothing found just yet.</p><p class="mt-2 text-sm text-stone-500">Try another search term.</p><a href="{{ route('store.index') }}" class="mt-5 inline-block text-sm font-semibold text-amber-800 underline underline-offset-4">Clear search</a></div>
    @else
        <div class="grid grid-cols-2 gap-x-4 gap-y-9 py-8 sm:gap-x-6 lg:grid-cols-4">
        @foreach ($products as $product)
            <article class="group"><a href="{{ route('store.show', $product) }}" class="relative block aspect-[4/5] overflow-hidden rounded-xl bg-gradient-to-br from-stone-200 via-stone-100 to-amber-100"><div class="absolute inset-0 flex items-center justify-center text-7xl font-serif text-stone-400/70 transition duration-500 group-hover:scale-110">{{ mb_substr($product->name, 0, 1) }}</div>@if ($product->compare_at_price && $product->compare_at_price > $product->price)<span class="absolute left-3 top-3 rounded-full bg-white px-3 py-1 text-[10px] font-semibold uppercase tracking-wider">Special price</span>@endif @if ($product->stock < 1)<span class="absolute bottom-3 left-3 rounded-full bg-stone-900 px-3 py-1 text-[10px] font-semibold uppercase tracking-wider text-white">Sold out</span>@endif</a><div class="pt-4"><p class="text-[11px] uppercase tracking-[.16em] text-stone-500">{{ $product->category }}</p><a href="{{ route('store.show', $product) }}" class="mt-1 block text-sm font-medium leading-5 hover:text-amber-800">{{ $product->name }}</a><div class="mt-2 flex items-center gap-2 text-sm"><span class="font-semibold">₹{{ number_format((float) $product->price, 2) }}</span>@if ($product->compare_at_price)<span class="text-xs text-stone-400 line-through">₹{{ number_format((float) $product->compare_at_price, 2) }}</span>@endif</div></div></article>
        @endforeach
        </div>
        <div class="border-t border-stone-200 pt-6">{{ $products->links() }}</div>
    @endif
</section>
@endsection
