<nav class="border-b border-gray-200 bg-white p-4 lg:hidden">
    <div class="grid grid-cols-2 gap-2 text-sm">
        <a class="rounded bg-gray-100 px-3 py-2" href="{{ route('dashboard') }}">Dashboard</a>
        <a class="rounded bg-gray-100 px-3 py-2" href="{{ route('referrals.index') }}">Referrals</a>
        <a class="rounded bg-gray-100 px-3 py-2" href="{{ route('orders.index') }}">Orders</a>
        <a class="rounded bg-gray-100 px-3 py-2" href="{{ route('settings.index') }}">Settings</a>
    </div>
</nav>
