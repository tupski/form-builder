<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-2 sm:space-y-0">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Submissions: {{ $form->title }}
            </h2>
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 w-full sm:w-auto">
                <a href="{{ route('forms.export-submissions', $form) }}" 
                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-center text-sm">
                    📊 Export Excel
                </a>
                <a href="{{ route('forms.index') }}" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-center text-sm">
                    ← Back to Forms
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <div class="text-xs font-medium text-gray-500">Total</div>
                                    <div class="text-lg font-bold text-gray-900">{{ $submissions->total() }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <div class="text-xs font-medium text-gray-500">Today</div>
                                    <div class="text-lg font-bold text-gray-900">{{ $submissions->where('created_at', '>=', today())->count() }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <div class="text-xs font-medium text-gray-500">This Week</div>
                                    <div class="text-lg font-bold text-gray-900">{{ $submissions->where('created_at', '>=', now()->startOfWeek())->count() }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <div class="text-xs font-medium text-gray-500">Fields</div>
                                    <div class="text-lg font-bold text-gray-900">{{ $form->fields->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($submissions->count() > 0)
                        <!-- Mobile View -->
                        <div class="block sm:hidden">
                            <div class="space-y-4">
                                @foreach($submissions as $submission)
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between items-start mb-3">
                                            <div class="text-sm font-medium text-gray-900">#{{ $submission->id }}</div>
                                            <div class="text-xs text-gray-500">{{ $submission->created_at->format('M d, Y H:i') }}</div>
                                        </div>
                                        
                                        <div class="space-y-2">
                                            @if($submission->data)
                                                @foreach($form->fields as $field)
                                                    @if(isset($submission->data[$field->name]))
                                                        <div class="flex flex-col">
                                                            <span class="text-xs font-medium text-gray-600">{{ $field->label }}:</span>
                                                            <span class="text-sm text-gray-900">
                                                                @if(is_array($submission->data[$field->name]))
                                                                    {{ implode(', ', $submission->data[$field->name]) }}
                                                                @else
                                                                    {{ $submission->data[$field->name] }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                        
                                        <div class="mt-3 pt-3 border-t border-gray-200">
                                            <div class="text-xs text-gray-500">
                                                IP: {{ $submission->ip_address ?? 'Unknown' }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Desktop View -->
                        <div class="hidden sm:block overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted At</th>
                                        @foreach($form->fields as $field)
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $field->label }}</th>
                                        @endforeach
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP Address</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($submissions as $submission)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                #{{ $submission->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <div>{{ $submission->created_at->format('M d, Y') }}</div>
                                                <div class="text-xs">{{ $submission->created_at->format('H:i:s') }}</div>
                                            </td>
                                            @foreach($form->fields as $field)
                                                <td class="px-6 py-4 text-sm text-gray-900">
                                                    <div class="max-w-xs truncate">
                                                        @if(isset($submission->data[$field->name]))
                                                            @if(is_array($submission->data[$field->name]))
                                                                {{ implode(', ', $submission->data[$field->name]) }}
                                                            @else
                                                                {{ $submission->data[$field->name] }}
                                                            @endif
                                                        @else
                                                            <span class="text-gray-400">-</span>
                                                        @endif
                                                    </div>
                                                </td>
                                            @endforeach
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $submission->ip_address ?? 'Unknown' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-6">
                            {{ $submissions->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No submissions yet</h3>
                            <p class="mt-1 text-sm text-gray-500">This form hasn't received any submissions yet.</p>
                            <div class="mt-6">
                                <a href="{{ route('form.show', $form->slug) }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    View Form
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
