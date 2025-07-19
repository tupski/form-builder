<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Submitted - {{ $form->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center">
                    <!-- Success Icon -->
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-6">
                        <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>

                    <!-- Success Message -->
                    <h1 class="text-2xl font-bold text-gray-900 mb-4">Thank You!</h1>
                    
                    <div class="text-gray-600 mb-6">
                        {{ $form->success_message }}
                    </div>

                    <!-- Form Title -->
                    <p class="text-sm text-gray-500 mb-8">
                        Your response to "{{ $form->title }}" has been recorded.
                    </p>

                    <!-- Actions -->
                    <div class="space-y-4">
                        <button onclick="window.close()" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-md transition duration-200">
                            Close Window
                        </button>
                        
                        <div>
                            <a href="{{ route('form.show', $form->slug) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                Submit another response
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
