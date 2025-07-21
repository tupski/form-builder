<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TailwindCSS Test</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-blue-600 mb-8">TailwindCSS Test Page</h1>
        
        <!-- Test Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Card 1</h2>
                <p class="text-gray-600 mb-4">This is a test card with TailwindCSS styling.</p>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Button
                </button>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Card 2</h2>
                <p class="text-gray-600 mb-4">Another test card with different colors.</p>
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Success
                </button>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Card 3</h2>
                <p class="text-gray-600 mb-4">Third test card with red button.</p>
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Danger
                </button>
            </div>
        </div>
        
        <!-- Test Form -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Test Form</h2>
            <form class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                    <textarea rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                    Submit
                </button>
            </form>
        </div>
        
        <!-- Test Alerts -->
        <div class="space-y-4 mb-8">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                <strong>Success!</strong> This is a success alert.
            </div>
            
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                <strong>Error!</strong> This is an error alert.
            </div>
            
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-lg">
                <strong>Info!</strong> This is an info alert.
            </div>
        </div>
        
        <!-- Test Responsive Grid -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Responsive Grid</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div class="bg-blue-100 p-4 rounded-lg text-center">1</div>
                <div class="bg-green-100 p-4 rounded-lg text-center">2</div>
                <div class="bg-yellow-100 p-4 rounded-lg text-center">3</div>
                <div class="bg-red-100 p-4 rounded-lg text-center">4</div>
                <div class="bg-purple-100 p-4 rounded-lg text-center">5</div>
                <div class="bg-pink-100 p-4 rounded-lg text-center">6</div>
                <div class="bg-indigo-100 p-4 rounded-lg text-center">7</div>
                <div class="bg-gray-100 p-4 rounded-lg text-center">8</div>
            </div>
        </div>
        
        <div class="mt-8 text-center">
            <a href="{{ route('landing') }}" class="text-blue-600 hover:text-blue-800 underline">
                ← Back to Landing Page
            </a>
        </div>
    </div>
</body>
</html>
