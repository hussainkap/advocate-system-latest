<header class="border-b border-gray-200 bg-white px-6 py-4">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-500">Welcome back</p>
            <h2 class="text-2xl font-semibold">@yield('page-title', 'Dashboard')</h2>
        </div>
        <div class="text-sm text-gray-500">
            {{ now()->format('M d, Y') }}
        </div>
    </div>
</header>
