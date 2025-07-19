<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Forms') }}
            </h2>
            <a href="{{ route('forms.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create New Form
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($forms->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($forms as $form)
                                <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $form->title }}</h3>
                                        <span class="px-2 py-1 text-xs rounded-full {{ $form->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $form->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                    
                                    @if($form->description)
                                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($form->description, 100) }}</p>
                                    @endif
                                    
                                    <div class="text-sm text-gray-500 mb-4">
                                        <p>Fields: {{ $form->fields->count() }}</p>
                                        <p>Submissions: {{ $form->submissions->count() }}</p>
                                        <p>Created: {{ $form->created_at->format('M d, Y') }}</p>
                                    </div>
                                    
                                    <div class="flex space-x-2">
                                        <a href="{{ route('forms.builder', $form) }}" class="bg-blue-500 hover:bg-blue-700 text-white text-xs font-bold py-2 px-3 rounded">
                                            Builder
                                        </a>
                                        <a href="{{ route('form.show', $form->slug) }}" target="_blank" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-2 px-3 rounded">
                                            Preview
                                        </a>
                                        <a href="{{ route('forms.edit', $form) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white text-xs font-bold py-2 px-3 rounded">
                                            Edit
                                        </a>
                                        <form action="{{ route('forms.destroy', $form) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this form?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white text-xs font-bold py-2 px-3 rounded">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-6">
                            {{ $forms->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No forms</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by creating your first form.</p>
                            <div class="mt-6">
                                <a href="{{ route('forms.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    Create New Form
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
