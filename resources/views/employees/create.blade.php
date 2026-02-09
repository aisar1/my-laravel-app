<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <nav class="bg-white shadow mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-xl font-bold text-blue-600">HR System</a>
                </div>
                <div class="flex items-center">
                    <a href="/" class="text-gray-500 hover:text-gray-700">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p class="font-bold">Success</p>
                <p>{{ session('success') }}</p>
                
                @if(str_contains(session('success'), 'Temporary Password'))
                    <div class="mt-2 bg-white p-2 rounded border border-green-200">
                        <strong>Copy this now:</strong> 
                        <span class="font-mono text-red-600 bg-gray-100 px-2 py-1 rounded select-all">
                            {{ substr(session('success'), strpos(session('success'), ':') + 2) }}
                        </span>
                    </div>
                @endif
            </div>
        @endif

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h2 class="text-xl font-semibold text-gray-800">Add New Employee</h2>
                <p class="text-sm text-gray-600">Fill in the details to register a new staff member.</p>
            </div>

            <form action="{{ route('employees.store') }}" method="POST" class="p-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                        <input type="text" name="first_name" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                        <input type="text" name="last_name" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="text" name="phone" placeholder="+60 12-345 6789" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                        <select name="department" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 border-gray-300 bg-white">
                            <option value="IT">IT Department</option>
                            <option value="HR">Human Resources</option>
                            <option value="Sales">Sales & Marketing</option>
                            <option value="Finance">Finance</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Position / Job Title</label>
                        <input type="text" name="position" placeholder="e.g. Software Engineer" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Basic Salary (RM)</label>
                        <input type="number" name="salary" step="0.01" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Joining Date</label>
                        <input type="date" name="joining_date" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 border-gray-300">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">System Role</label>
                        <select name="role" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 border-gray-300 bg-white">
                            <option value="staff">Staff (Standard Access)</option>
                            <option value="admin">Admin (Full Access)</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Admins can create/delete employees. Staff can only view their own profile.</p>
                    </div>

                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-semibold shadow-md transition duration-200">
                        + Create Employee
                    </button>
                </div>

            </form>
        </div>
    </div>
</body>
</html>