<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Payslip</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    

    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <div class="mb-6 flex items-center justify-between">
            
            <a href="{{ route('homepage') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">&larr; Back to Dashboard</a>
        </div>

        <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">
            
            <div class="mb-6 flex items-center justify-between">
    <h1 class="text-2xl font-bold text-gray-800">My Salary Details</h1>
    
    <div class="flex space-x-4">
        <a href="{{ route('salary.download') }}" class="flex items-center bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-700 transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
            Download PDF
        </a>

        
    </div>
</div>
            
            <div class="bg-gray-800 px-6 py-4 flex justify-between items-center">
                <div>
                    <h2 class="text-white text-lg font-bold uppercase tracking-wider">Payslip</h2>
                    <p class="text-gray-400 text-sm">{{ \Carbon\Carbon::now()->format('F Y') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-white font-bold">{{ config('app.name') }}</p>
                    <p class="text-gray-400 text-xs">Confidential</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 px-8 py-6 border-b border-gray-100 bg-gray-50">
                <div>
                    <p class="text-xs text-gray-500 uppercase">Employee Name</p>
                    <p class="font-bold text-gray-800">{{ $user->first_name }} {{ $user->last_name }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-500 uppercase">Designation</p>
                    <p class="font-bold text-gray-800">{{ $user->position }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase">Department</p>
                    <p class="font-bold text-gray-800">{{ $user->department }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-500 uppercase">Join Date</p>
                    <p class="font-bold text-gray-800">{{ $user->joining_date ? $user->joining_date->format('d M Y') : '-' }}</p>
                </div>
            </div>

            <div class="px-8 py-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <div>
                        <h3 class="text-sm font-bold text-green-600 uppercase mb-4 border-b pb-2">Earnings</h3>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Basic Salary</span>
                            <span class="font-semibold text-gray-900">{{ number_format($basic, 2) }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Allowances</span>
                            <span class="font-semibold text-gray-900">0.00</span>
                        </div>
                        <div class="flex justify-between mb-2 pt-4 mt-4 border-t border-dashed">
                            <span class="font-bold text-gray-800">Total Earnings</span>
                            <span class="font-bold text-gray-900">{{ number_format($basic, 2) }}</span>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-red-600 uppercase mb-4 border-b pb-2">Deductions (Est.)</h3>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">EPF (11%)</span>
                            <span class="font-semibold text-red-600">-{{ number_format($epf, 2) }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">SOCSO (0.5%)</span>
                            <span class="font-semibold text-red-600">-{{ number_format($socso, 2) }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">EIS (0.2%)</span>
                            <span class="font-semibold text-red-600">-{{ number_format($eis, 2) }}</span>
                        </div>
                        <div class="flex justify-between mb-2 pt-4 mt-4 border-t border-dashed">
                            <span class="font-bold text-gray-800">Total Deductions</span>
                            <span class="font-bold text-red-600">-{{ number_format($totalDeductions, 2) }}</span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="bg-gray-50 px-8 py-6 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Net Pay (Month)</p>
                        <p class="text-xs text-gray-400">Credited to Bank Account</p>
                    </div>
                    <div class="text-3xl font-bold text-green-700">
                        RM {{ number_format($netPay, 2) }}
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>