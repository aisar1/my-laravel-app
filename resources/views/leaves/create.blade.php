<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply Leave</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Apply for Leave</h2>
                <a href="{{ route('leaves.index') }}" class="text-sm text-blue-600 hover:underline">Back to List</a>
            </div>

            <form action="{{ route('leaves.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Leave Type</label>
                    <select name="type" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500">
                        <option value="Annual">Annual Leave</option>
                        <option value="Sick">Sick Leave</option>
                        <option value="Casual">Casual Leave</option>
                        <option value="Unpaid">Unpaid Leave</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Start Date</label>
                    <input type="date" name="start_date" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">End Date</label>
                    <input type="date" name="end_date" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Reason</label>
                    <textarea name="reason" rows="3" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500" placeholder="Why do you need leave?"></textarea>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150">
                    Submit Application
                </button>
            </form>
        </div>
    </div>

</body>
</html>