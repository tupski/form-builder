<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Form Builder: {{ $form->title }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('form.show', $form->slug) }}" target="_blank" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Preview Form
                </a>
                <a href="{{ route('forms.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Forms
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Success Message -->
                    <div id="success-message" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <span id="success-text"></span>
                    </div>

                    <!-- Error Message -->
                    <div id="error-message" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <span id="error-text"></span>
                    </div>

                    <div class="grid grid-cols-12 gap-6">
                        <!-- Field Types Panel -->
                        <div class="col-span-3">
                            <h3 class="text-lg font-semibold mb-4">Field Types</h3>
                            <div class="space-y-2" id="field-types">
                                <div class="field-type bg-blue-100 border border-blue-300 rounded p-3 cursor-move hover:bg-blue-200" data-type="text">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                        </svg>
                                        Text Input
                                    </div>
                                </div>
                                <div class="field-type bg-blue-100 border border-blue-300 rounded p-3 cursor-move hover:bg-blue-200" data-type="email">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                        </svg>
                                        Email
                                    </div>
                                </div>
                                <div class="field-type bg-blue-100 border border-blue-300 rounded p-3 cursor-move hover:bg-blue-200" data-type="number">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                        </svg>
                                        Number
                                    </div>
                                </div>
                                <div class="field-type bg-blue-100 border border-blue-300 rounded p-3 cursor-move hover:bg-blue-200" data-type="textarea">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                        </svg>
                                        Textarea
                                    </div>
                                </div>
                                <div class="field-type bg-blue-100 border border-blue-300 rounded p-3 cursor-move hover:bg-blue-200" data-type="select">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                        </svg>
                                        Select Dropdown
                                    </div>
                                </div>
                                <div class="field-type bg-blue-100 border border-blue-300 rounded p-3 cursor-move hover:bg-blue-200" data-type="radio">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Radio Buttons
                                    </div>
                                </div>
                                <div class="field-type bg-blue-100 border border-blue-300 rounded p-3 cursor-move hover:bg-blue-200" data-type="checkbox">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Checkboxes
                                    </div>
                                </div>
                                <div class="field-type bg-blue-100 border border-blue-300 rounded p-3 cursor-move hover:bg-blue-200" data-type="date">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Date
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Builder Area -->
                        <div class="col-span-6">
                            <!-- Tabs -->
                            <div class="flex flex-wrap border-b border-gray-200 mb-4">
                                <button class="tab-button active px-3 py-2 text-xs sm:text-sm font-medium text-blue-600 border-b-2 border-blue-600" data-tab="fields">
                                    Fields
                                </button>
                                <button class="tab-button px-3 py-2 text-xs sm:text-sm font-medium text-gray-500 hover:text-gray-700" data-tab="conditions">
                                    Logic
                                </button>
                                <button class="tab-button px-3 py-2 text-xs sm:text-sm font-medium text-gray-500 hover:text-gray-700" data-tab="share">
                                    Share & Embed
                                </button>
                            </div>

                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold" id="tab-title">Form Fields</h3>
                                <div class="space-x-2">
                                    <button id="save-form" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Save Form
                                    </button>
                                    <button id="save-conditions" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded hidden">
                                        Save Conditions
                                    </button>
                                    <button id="save-share-settings" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded hidden">
                                        Save Settings
                                    </button>
                                </div>
                            </div>

                            <!-- Fields Tab Content -->
                            <div id="fields-tab" class="tab-content">
                                <div id="form-builder" class="min-h-96 border-2 border-dashed border-gray-300 rounded-lg p-4">
                                    <div id="drop-zone" class="min-h-full">
                                        <div id="empty-state" class="text-center py-12 text-gray-500">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            <p class="mt-2">Drag field types here to build your form</p>
                                        </div>
                                        <div id="form-fields"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Conditional Logic Tab Content -->
                            <div id="conditions-tab" class="tab-content hidden">
                                <div class="bg-white border border-gray-300 rounded-lg p-4">
                                    <div class="mb-4">
                                        <button id="add-condition" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                                            Add Condition Rule
                                        </button>
                                    </div>

                                    <div id="conditional-rules">
                                        <div id="no-conditions" class="text-center py-8 text-gray-500">
                                            <p>No conditional rules defined.</p>
                                            <p class="text-sm mt-1">Add rules to show/hide fields based on other field values.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Share & Embed Tab Content -->
                            <div id="share-tab" class="tab-content hidden">
                                <div class="bg-white border border-gray-300 rounded-lg p-4 space-y-6">
                                    <!-- Form URLs -->
                                    <div>
                                        <h3 class="text-lg font-semibold mb-4">Form URLs</h3>

                                        <!-- Default URL -->
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Default URL</label>
                                            <div class="flex">
                                                <input type="text" id="default-url" value="{{ route('form.show', $form->slug) }}"
                                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md bg-gray-50" readonly>
                                                <button onclick="copyToClipboard('default-url')"
                                                        class="px-4 py-2 bg-blue-500 text-white rounded-r-md hover:bg-blue-600">
                                                    Copy
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Custom URL -->
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Custom URL</label>
                                            <div class="flex">
                                                <span class="px-3 py-2 bg-gray-100 border border-r-0 border-gray-300 rounded-l-md text-sm">{{ url('/f/') }}/</span>
                                                <input type="text" id="custom-url" value="{{ $form->custom_url }}"
                                                       placeholder="my-custom-form"
                                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-r-md">
                                            </div>
                                            <p class="text-xs text-gray-500 mt-1">Leave empty to use default URL</p>
                                        </div>

                                        <!-- Short URL -->
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Short URL</label>
                                            <div class="flex">
                                                <input type="text" id="short-url"
                                                       value="{{ $form->short_url ? url('/f/' . $form->short_url) : '' }}"
                                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md bg-gray-50" readonly>
                                                <button onclick="generateShortUrl()"
                                                        class="px-4 py-2 bg-green-500 text-white rounded-r-md hover:bg-green-600">
                                                    {{ $form->short_url ? 'Regenerate' : 'Generate' }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Embed Code -->
                                    <div>
                                        <h3 class="text-lg font-semibold mb-4">Embed Code</h3>

                                        <div class="mb-4">
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Width</label>
                                                    <input type="text" id="embed-width" value="100%"
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Height</label>
                                                    <input type="text" id="embed-height" value="600px"
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                                </div>
                                            </div>

                                            <textarea id="embed-code" rows="4"
                                                      class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 font-mono text-sm"
                                                      readonly></textarea>

                                            <div class="flex justify-between mt-2">
                                                <button onclick="updateEmbedCode()"
                                                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                                                    Update Code
                                                </button>
                                                <button onclick="copyToClipboard('embed-code')"
                                                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 text-sm">
                                                    Copy Code
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Embed Settings -->
                                    <div>
                                        <h3 class="text-lg font-semibold mb-4">Embed Settings</h3>

                                        <div class="space-y-3">
                                            <label class="flex items-center">
                                                <input type="checkbox" id="is-embeddable" {{ $form->is_embeddable ? 'checked' : '' }}
                                                       class="mr-2">
                                                <span class="text-sm">Allow form to be embedded</span>
                                            </label>

                                            <label class="flex items-center">
                                                <input type="checkbox" id="hide-header" class="mr-2">
                                                <span class="text-sm">Hide form header in embed</span>
                                            </label>

                                            <label class="flex items-center">
                                                <input type="checkbox" id="transparent-bg" class="mr-2">
                                                <span class="text-sm">Transparent background</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Field Properties Panel -->
                        <div class="col-span-3">
                            <h3 class="text-lg font-semibold mb-4">Field Properties</h3>
                            <div id="field-properties" class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                <p class="text-gray-500 text-center">Select a field to edit its properties</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include form builder JavaScript -->
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        // Form builder data
        let formFields = @json($form->fields);
        let fieldCounter = formFields.length;

        // Initialize form builder
        document.addEventListener('DOMContentLoaded', function() {
            initializeFormBuilder();
            loadExistingFields();
        });
    </script>
    <script src="{{ asset('js/form-builder.js') }}"></script>
    @endpush
</x-app-layout>
