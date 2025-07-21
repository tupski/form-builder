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
                            <div class="space-y-2 max-h-96 overflow-y-auto" id="field-types">
                                <!-- Basic Input Fields -->
                                <div class="field-type bg-blue-100 border border-blue-300 rounded p-2 cursor-move hover:bg-blue-200 transition duration-200" data-type="text" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-font text-blue-600 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-blue-800">Text Input</span>
                                    </div>
                                </div>

                                <div class="field-type bg-green-100 border border-green-300 rounded p-2 cursor-move hover:bg-green-200 transition duration-200" data-type="email" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-envelope text-green-600 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-green-800">Email</span>
                                    </div>
                                </div>

                                <div class="field-type bg-yellow-100 border border-yellow-300 rounded p-2 cursor-move hover:bg-yellow-200 transition duration-200" data-type="textarea" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-align-left text-yellow-600 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-yellow-800">Textarea</span>
                                    </div>
                                </div>

                                <div class="field-type bg-pink-100 border border-pink-300 rounded p-2 cursor-move hover:bg-pink-200 transition duration-200" data-type="number" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-hashtag text-pink-600 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-pink-800">Number</span>
                                    </div>
                                </div>

                                <div class="field-type bg-orange-100 border border-orange-300 rounded p-2 cursor-move hover:bg-orange-200 transition duration-200" data-type="password" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-lock text-orange-600 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-orange-800">Password</span>
                                    </div>
                                </div>

                                <div class="field-type bg-cyan-100 border border-cyan-300 rounded p-2 cursor-move hover:bg-cyan-200 transition duration-200" data-type="url" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-link text-cyan-600 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-cyan-800">URL</span>
                                    </div>
                                </div>

                                <div class="field-type bg-lime-100 border border-lime-300 rounded p-2 cursor-move hover:bg-lime-200 transition duration-200" data-type="tel" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-phone text-lime-600 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-lime-800">Phone</span>
                                    </div>
                                </div>

                                <!-- Selection Fields -->
                                <div class="field-type bg-purple-100 border border-purple-300 rounded p-2 cursor-move hover:bg-purple-200 transition duration-200" data-type="select" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-list text-purple-600 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-purple-800">Select</span>
                                    </div>
                                </div>

                                <div class="field-type bg-red-100 border border-red-300 rounded p-2 cursor-move hover:bg-red-200 transition duration-200" data-type="radio" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-dot-circle text-red-600 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-red-800">Radio</span>
                                    </div>
                                </div>

                                <div class="field-type bg-indigo-100 border border-indigo-300 rounded p-2 cursor-move hover:bg-indigo-200 transition duration-200" data-type="checkbox" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-check-square text-indigo-600 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-indigo-800">Checkbox</span>
                                    </div>
                                </div>

                                <!-- Date & Time Fields -->
                                <div class="field-type bg-teal-100 border border-teal-300 rounded p-2 cursor-move hover:bg-teal-200 transition duration-200" data-type="date" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar text-teal-600 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-teal-800">Date</span>
                                    </div>
                                </div>

                                <div class="field-type bg-emerald-100 border border-emerald-300 rounded p-2 cursor-move hover:bg-emerald-200 transition duration-200" data-type="time" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-clock text-emerald-600 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-emerald-800">Time</span>
                                    </div>
                                </div>

                                <div class="field-type bg-violet-100 border border-violet-300 rounded p-2 cursor-move hover:bg-violet-200 transition duration-200" data-type="datetime" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-alt text-violet-600 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-violet-800">DateTime</span>
                                    </div>
                                </div>

                                <!-- File & Media Fields -->
                                <div class="field-type bg-rose-100 border border-rose-300 rounded p-2 cursor-move hover:bg-rose-200 transition duration-200" data-type="file" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-upload text-rose-600 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-rose-800">File Upload</span>
                                    </div>
                                </div>

                                <div class="field-type bg-sky-100 border border-sky-300 rounded p-2 cursor-move hover:bg-sky-200 transition duration-200" data-type="image" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-image text-sky-600 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-sky-800">Image</span>
                                    </div>
                                </div>

                                <!-- Content Fields -->
                                <div class="field-type bg-amber-100 border border-amber-300 rounded p-2 cursor-move hover:bg-amber-200 transition duration-200" data-type="header" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-heading text-amber-600 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-amber-800">Header</span>
                                    </div>
                                </div>

                                <div class="field-type bg-slate-100 border border-slate-300 rounded p-2 cursor-move hover:bg-slate-200 transition duration-200" data-type="paragraph" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-paragraph text-slate-600 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-slate-800">Paragraph</span>
                                    </div>
                                </div>

                                <div class="field-type bg-neutral-100 border border-neutral-300 rounded p-2 cursor-move hover:bg-neutral-200 transition duration-200" data-type="divider" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-minus text-neutral-600 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-neutral-800">Divider</span>
                                    </div>
                                </div>

                                <!-- Advanced Fields -->
                                <div class="field-type bg-fuchsia-100 border border-fuchsia-300 rounded p-2 cursor-move hover:bg-fuchsia-200 transition duration-200" data-type="rating" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-fuchsia-600 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-fuchsia-800">Rating</span>
                                    </div>
                                </div>

                                <div class="field-type bg-stone-100 border border-stone-300 rounded p-2 cursor-move hover:bg-stone-200 transition duration-200" data-type="range" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-sliders-h text-stone-600 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-stone-800">Range</span>
                                    </div>
                                </div>

                                <div class="field-type bg-red-200 border border-red-400 rounded p-2 cursor-move hover:bg-red-300 transition duration-200" data-type="captcha" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-shield-alt text-red-700 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-red-900">Captcha</span>
                                    </div>
                                </div>

                                <div class="field-type bg-green-200 border border-green-400 rounded p-2 cursor-move hover:bg-green-300 transition duration-200" data-type="signature" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-signature text-green-700 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-green-900">Signature</span>
                                    </div>
                                </div>

                                <div class="field-type bg-blue-200 border border-blue-400 rounded p-2 cursor-move hover:bg-blue-300 transition duration-200" data-type="color" draggable="true">
                                    <div class="flex items-center">
                                        <i class="fas fa-palette text-blue-700 mr-2 text-sm"></i>
                                        <span class="text-sm font-medium text-blue-900">Color</span>
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
