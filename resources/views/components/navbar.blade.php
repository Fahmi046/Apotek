<!-- resources/views/components/navbar.blade.php -->
<nav class="bg-blue-600 text-white px-6 py-4 flex justify-between items-center shadow">
    <!-- Logo -->
    <div class="text-xl font-bold">MyApp</div>

    <!-- Menu -->
    <ul class="hidden md:flex space-x-6">
        <li><a href="/dashboard" class="hover:underline">Dashboard</a></li>
        <li><a href="/products" class="hover:underline">Products</a></li>
        <li><a href="/sales" class="hover:underline">Sales</a></li>
        <li><a href="/reports" class="hover:underline">Reports</a></li>
    </ul>

    <!-- Profile -->
    <div class="flex items-center space-x-3">
        <span class="text-sm">Hi, Fahmi</span>
        <img src="https://i.pravatar.cc/40" alt="User" class="w-10 h-10 rounded-full border-2 border-white">
    </div>
</nav>
