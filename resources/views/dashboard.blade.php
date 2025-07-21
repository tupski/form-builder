<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-2 sm:space-y-0">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Welcome back, {{ Auth::user()->name }}!
                </h2>
                <p class="text-sm text-gray-600 mt-1">Here's what's happening with your forms today.</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('forms.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 shadow-lg">
                    <i class="fas fa-plus mr-2"></i>Create New Form
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-wpforms text-blue-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-500">Total Forms</div>
                            <div class="text-2xl font-bold text-gray-900">{{ Auth::user()->forms->count() }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-check-circle text-green-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-500">Active Forms</div>
                            <div class="text-2xl font-bold text-gray-900">{{ Auth::user()->forms->where('is_active', true)->count() }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-paper-plane text-yellow-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-500">Total Submissions</div>
                            <div class="text-2xl font-bold text-gray-900">{{ Auth::user()->forms->sum(function($form) { return $form->submissions->count(); }) }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-calendar-day text-purple-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-500">Today's Submissions</div>
                            <div class="text-2xl font-bold text-gray-900">
                                {{ Auth::user()->forms->sum(function($form) {
                                    return $form->submissions->where('created_at', '>=', today())->count();
                                }) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Forms and Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Recent Forms -->
                <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900">Recent Forms</h3>
                            <a href="{{ route('forms.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
                        </div>
                    </div>
                    <div class="p-6">
                        @if(Auth::user()->forms->count() > 0)
                            <div class="space-y-4">
                                @foreach(Auth::user()->forms->take(5) as $form)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-200">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-wpforms text-blue-600"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-900">{{ $form->title }}</h4>
                                                <p class="text-sm text-gray-500">
                                                    {{ $form->submissions->count() }} submissions •
                                                    {{ $form->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $form->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ $form->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                            <a href="{{ route('forms.builder', $form) }}" class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-wpforms text-4xl text-gray-400 mb-4"></i>
                                <h4 class="text-lg font-medium text-gray-900 mb-2">No forms yet</h4>
                                <p class="text-gray-500 mb-4">Create your first form to get started</p>
                                <a href="{{ route('forms.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                                    Create Your First Form
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="{{ route('forms.create') }}" class="flex items-center p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition duration-200">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-plus text-blue-600"></i>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">Create New Form</div>
                                    <div class="text-sm text-gray-500">Start building a new form</div>
                                </div>
                            </a>

                            <a href="{{ route('forms.index') }}" class="flex items-center p-3 bg-green-50 rounded-lg hover:bg-green-100 transition duration-200">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-list text-green-600"></i>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">Manage Forms</div>
                                    <div class="text-sm text-gray-500">View and edit your forms</div>
                                </div>
                            </a>

                            <a href="{{ route('profile.edit') }}" class="flex items-center p-3 bg-purple-50 rounded-lg hover:bg-purple-100 transition duration-200">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-purple-600"></i>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">Profile Settings</div>
                                    <div class="text-sm text-gray-500">Update your profile</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            @if(Auth::user()->forms->sum(function($form) { return $form->submissions->count(); }) > 0)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach(Auth::user()->forms->flatMap->submissions->sortByDesc('created_at')->take(5) as $submission)
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-paper-plane text-gray-600 text-sm"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-900">
                                            New submission received for <strong>{{ $submission->form->title }}</strong>
                                        </p>
                                        <p class="text-xs text-gray-500">{{ $submission->created_at->diffForHumans() }}</p>
                                    </div>
                                    <a href="{{ route('forms.submissions', $submission->form) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                        View
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
