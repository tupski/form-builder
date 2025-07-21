<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-2 sm:space-y-0">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Profile Settings
                </h2>
                <p class="text-sm text-gray-600 mt-1">Manage your account settings and preferences.</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Profile Overview -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                <div class="p-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-blue-600">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">{{ Auth::user()->name }}</h3>
                            <p class="text-gray-600">{{ Auth::user()->email }}</p>
                            <div class="flex items-center mt-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ Auth::user()->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst(Auth::user()->role ?? 'user') }}
                                </span>
                                <span class="ml-3 text-sm text-gray-500">
                                    Member since {{ Auth::user()->created_at->format('M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-wpforms text-blue-600"></i>
                        </div>
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-500">Forms Created</div>
                            <div class="text-xl font-bold text-gray-900">{{ Auth::user()->forms->count() }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-paper-plane text-green-600"></i>
                        </div>
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-500">Total Submissions</div>
                            <div class="text-xl font-bold text-gray-900">{{ Auth::user()->forms->sum(function($form) { return $form->submissions->count(); }) }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar text-yellow-600"></i>
                        </div>
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-500">Last Activity</div>
                            <div class="text-sm font-bold text-gray-900">{{ Auth::user()->updated_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Sections -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Profile Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-user text-blue-600 mr-2"></i>
                            Profile Information
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">Update your account's profile information and email address.</p>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-lock text-green-600 mr-2"></i>
                            Update Password
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">Ensure your account is using a long, random password to stay secure.</p>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="bg-white rounded-lg shadow-sm border border-red-200 mt-6">
                <div class="p-6 border-b border-red-200">
                    <h3 class="text-lg font-semibold text-red-900 flex items-center">
                        <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>
                        Danger Zone
                    </h3>
                    <p class="text-sm text-red-600 mt-1">Once you delete your account, all of your resources and data will be permanently deleted.</p>
                </div>
                <div class="p-6">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
