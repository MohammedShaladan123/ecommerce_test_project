<header class="bg-gradient-to-r from-blue-500 to-purple-600 text-white py-6 shadow-lg">
    <div class="container mx-auto flex justify-between items-center px-6">
        <h1 class="text-3xl font-bold">My Store 🛒</h1>

        <nav class="flex items-center space-x-4">
            <a href="/" class="text-lg px-4 py-2 hover:text-gray-300">Home</a>
            <a href="{{ route('shop') }}" class="text-lg px-4 py-2 hover:text-gray-300">Shop</a>

            @guest
                <a href="{{ route('login') }}"
                    class="bg-white text-blue-600 px-4 py-2 rounded-lg font-semibold shadow-md hover:bg-gray-100 transition">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="bg-yellow-400 text-gray-900 px-4 py-2 rounded-lg font-semibold shadow-md hover:bg-yellow-500 transition">
                    Register
                </a>
            @else
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded-lg font-semibold shadow-md hover:bg-red-600 transition">
                        Logout
                    </button>
                </form>
            @endguest
        </nav>
    </div>
</header>
