<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <h1 class="text-white font-extrabold">Jalongjang Motor</h1>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{ route('overview.index') }}"
                            class="{{ Route::currentRouteName() === 'overview.index' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">
                            Overview
                        </a>
                        <a href="{{ route('antrian.index') }}"
                            class="{{ Route::currentRouteName() === 'antrian.index' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">
                            Antrian
                        </a>
                        <a href="{{ route('rekap.mingguan') }}"
                            class="{{ Route::currentRouteName() === 'rekap.mingguan' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">
                            Rekap
                        </a>
                    </div>
                </div>
            </div>
            <div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn bg-indigo-500 p-2 rounded-md text-white">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>
