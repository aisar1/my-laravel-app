<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <nav class="bg-white shadow-sm border-b border-gray-200 relative z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                
                <div class="flex items-center">
                    <button onclick="toggleDrawer()" class="p-2 rounded-md text-gray-500 hover:text-blue-600 hover:bg-gray-100 focus:outline-none mr-3 transition duration-150">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <a href="{{ route('homepage') }}" class="flex items-center text-blue-600 font-bold text-xl">
                        HR System
                    </a>
                </div>

                <div class="flex items-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-500 hover:text-red-600 font-medium transition duration-150">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <aside id="drawer" class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-2xl transform -translate-x-full transition-transform duration-300 ease-in-out">
        
        <div class="flex items-center justify-between h-16 px-6 border-b bg-gray-50">
            <span class="text-lg font-bold text-gray-800">Menu</span>
            <button onclick="toggleDrawer()" class="text-gray-500 hover:text-red-500 focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav class="mt-6 px-4 space-y-2">
            
            <a href="/" class="flex items-center px-4 py-3 bg-blue-50 text-blue-600 rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="{{ route('salary.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 hover:text-green-600 rounded-lg transition-colors duration-200">
    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <span class="font-medium">My Salary</span>
</a>
<a href="{{ route('password.edit') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 hover:text-blue-600 rounded-lg transition-colors duration-200">
    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
    </svg>
    <span class="font-medium">Change Password</span>
</a>

@if(auth()->user()->role === 'admin')
            <a href="{{ route('register') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 hover:text-blue-600 rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                <span class="font-medium">Add New Staff</span>
            </a>
@endif
        </nav>
    </aside>

    <div id="drawer-overlay" onclick="toggleDrawer()" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden transition-opacity duration-300 backdrop-blur-sm"></div>


    <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                <p class="mt-1 text-sm text-gray-500">Welcome back, {{ $user->first_name }}. Here is your personnel file.</p>
            </div>
            <div class="hidden sm:block">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                    {{ \Carbon\Carbon::now()->format('l, d M Y') }}
                </span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            
            <div class="h-32 bg-gradient-to-r from-blue-600 to-indigo-700"></div>

            <div class="px-6 sm:px-10 pb-10">
                
                <div class="relative flex flex-col sm:flex-row items-start sm:items-end -mt-12 mb-8">
                    <div class="h-24 w-24 rounded-xl ring-4 ring-white bg-white flex items-center justify-center shadow-md z-10">
                        <div class="h-full w-full rounded-lg bg-gray-800 flex items-center justify-center text-3xl font-bold text-white uppercase">
                            {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                        </div>
                    </div>
                    <div class="mt-4 sm:mt-0 sm:ml-6 flex-1">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</h2>
                        <div class="flex flex-wrap items-center gap-2 mt-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $user->department ?? 'Unassigned' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-8">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2 lg:grid-cols-3">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                            <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ $user->email }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Phone</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $user->phone ?? 'N/A' }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Job Title</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $user->position ?? 'N/A' }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Joining Date</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $user->joining_date ? $user->joining_date->format('d M Y') : 'N/A' }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Salary</dt>
                                <dd class="mt-1 text-2xl font-bold text-gray-900">RM {{ number_format($user->salary, 2) }}</dd>
                            </div>
                        </div>
                    </dl>
                </div>

            </div>
        </div>
    </main>

    <script>
        function toggleDrawer() {
            const drawer = document.getElementById('drawer');
            const overlay = document.getElementById('drawer-overlay');
            
            if (drawer.classList.contains('-translate-x-full')) {
                // Open
                drawer.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                // Close
                drawer.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }
    </script>

</body>
</html>