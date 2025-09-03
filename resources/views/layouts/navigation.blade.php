<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center text-xl font-bold text-gray-800">
                    ClassifiedsApp
                </a>
                <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ route('ads.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:border-indigo-500 hover:text-gray-700">
                        All Ads
                    </a>
                    <a href="{{ route('categories.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:border-indigo-500 hover:text-gray-700">
                        Categories
                    </a>
                    @auth
                        <a href="{{ route('ads.my') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:border-indigo-500 hover:text-gray-700">
                            My Ads
                        </a>
                        <a href="{{ route('ads.create') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:border-indigo-500 hover:text-gray-700">
                                Create Ad
                        </a>
                    @endauth
                </div>
            </div>

            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                @auth
                    <a href="{{ route('profile.edit') }}" class="text-sm text-gray-500 hover:text-gray-700 mr-4">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-500 hover:text-red-700">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-gray-700 mr-4">Login</a>
                    <a href="{{ route('register') }}" class="text-sm text-gray-500 hover:text-gray-700">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
