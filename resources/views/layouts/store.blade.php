<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'Thoughtfully selected everyday essentials.')">
    <title>@yield('title', 'Form & Function') · {{ config('app.name', 'Form & Function') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-stone-50 text-stone-900 antialiased">
    <div class="border-b border-stone-800 bg-stone-950 px-4 py-2 text-center text-xs tracking-wide text-stone-200">Thoughtful essentials. Made for everyday life.</div>
    <header class="sticky top-0 z-20 border-b border-stone-200 bg-stone-50/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-5 py-4">
            <a href="{{ route('store.index') }}" class="text-xl font-semibold tracking-tight">FORM <span class="text-amber-700">&</span> FUNCTION</a>
            <nav class="hidden items-center gap-7 text-sm text-stone-600 md:flex"><a href="{{ route('store.index') }}">Shop</a><a href="{{ route('store.index', ['q' => 'Workspace']) }}">Workspace</a><a href="{{ route('store.index', ['q' => 'Home']) }}">Home</a></nav>
            <a href="{{ route('cart.index') }}" class="rounded-full border border-stone-300 px-4 py-2 text-sm font-medium">Bag <span class="ml-1 text-amber-700">({{ array_sum(session('cart', [])) }})</span></a>
        </div>
    </header>
    @if (session('status'))<div class="mx-auto mt-5 max-w-7xl px-5"><p role="status" class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('status') }}</p></div>@endif
    @if ($errors->any())<div class="mx-auto mt-5 max-w-7xl px-5"><div role="alert" class="rounded-lg bg-red-50 px-4 py-3 text-sm text-red-800">{{ $errors->first() }}</div></div>@endif
    <main>@yield('content')</main>
    <footer class="mt-20 border-t border-stone-200 bg-white"><div class="mx-auto flex max-w-7xl flex-col gap-3 px-5 py-10 text-sm text-stone-500 sm:flex-row sm:items-center sm:justify-between"><span class="font-semibold tracking-wide text-stone-800">FORM & FUNCTION</span><span>Designed around the things you use every day.</span><span>© {{ date('Y') }} {{ config('app.name', 'Form & Function') }}</span></div></footer>
</body>
</html>
