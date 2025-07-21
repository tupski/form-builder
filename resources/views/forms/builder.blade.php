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
                            <h3 class="text-lg font-semibold mb-2">Field Types</h3>
                            <p class="text-xs text-gray-600 mb-4">
                                <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                                Click or drag field types to add them to your form
                            </p>
                            <div class="space-y-3 max-h-96 overflow-y-auto" id="field-types">
                                <!-- 1. Field Teks -->
                                <div class="field-category mb-4">
                                    <h3 class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-font text-blue-600 mr-2"></i>
                                        Field Teks
                                    </h3>
                                    <div class="space-y-1">
                                        <div class="field-type bg-blue-50 border border-blue-200 rounded p-2 cursor-move hover:bg-blue-100 transition duration-200" data-type="text" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-i-cursor text-blue-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-blue-800">Single Line Text</span>
                                            </div>
                                        </div>

                                        <div class="field-type bg-blue-50 border border-blue-200 rounded p-2 cursor-move hover:bg-blue-100 transition duration-200" data-type="textarea" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-align-left text-blue-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-blue-800">Paragraph Text</span>
                                            </div>
                                        </div>

                                        <div class="field-type bg-blue-50 border border-blue-200 rounded p-2 cursor-move hover:bg-blue-100 transition duration-200" data-type="password" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-lock text-blue-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-blue-800">Password</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2. Angka dan Pilihan Terbatas -->
                                <div class="field-category mb-4">
                                    <h3 class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-list-ol text-green-600 mr-2"></i>
                                        Angka dan Pilihan Terbatas
                                    </h3>
                                    <div class="space-y-1">
                                        <div class="field-type bg-green-50 border border-green-200 rounded p-2 cursor-move hover:bg-green-100 transition duration-200" data-type="number" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-hashtag text-green-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-green-800">Number</span>
                                            </div>
                                        </div>

                                        <div class="field-type bg-green-50 border border-green-200 rounded p-2 cursor-move hover:bg-green-100 transition duration-200" data-type="select" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-chevron-down text-green-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-green-800">Dropdown / Select</span>
                                            </div>
                                        </div>

                                        <div class="field-type bg-green-50 border border-green-200 rounded p-2 cursor-move hover:bg-green-100 transition duration-200" data-type="radio" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-dot-circle text-green-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-green-800">Radio Button</span>
                                            </div>
                                        </div>

                                        <div class="field-type bg-green-50 border border-green-200 rounded p-2 cursor-move hover:bg-green-100 transition duration-200" data-type="checkbox" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-check-square text-green-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-green-800">Checkbox(es)</span>
                                            </div>
                                        </div>

                                        <div class="field-type bg-green-50 border border-green-200 rounded p-2 cursor-move hover:bg-green-100 transition duration-200" data-type="range" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-sliders-h text-green-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-green-800">Range / Slider</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 3. Tanggal dan Waktu -->
                                <div class="field-category mb-4">
                                    <h3 class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-calendar-alt text-yellow-600 mr-2"></i>
                                        Tanggal dan Waktu
                                    </h3>
                                    <div class="space-y-1">
                                        <div class="field-type bg-yellow-50 border border-yellow-200 rounded p-2 cursor-move hover:bg-yellow-100 transition duration-200" data-type="date" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-calendar text-yellow-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-yellow-800">Date</span>
                                            </div>
                                        </div>

                                        <div class="field-type bg-yellow-50 border border-yellow-200 rounded p-2 cursor-move hover:bg-yellow-100 transition duration-200" data-type="time" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-clock text-yellow-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-yellow-800">Time</span>
                                            </div>
                                        </div>

                                        <div class="field-type bg-yellow-50 border border-yellow-200 rounded p-2 cursor-move hover:bg-yellow-100 transition duration-200" data-type="datetime" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-calendar-plus text-yellow-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-yellow-800">Datetime</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 4. Kontak dan Identitas -->
                                <div class="field-category mb-4">
                                    <h3 class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-address-card text-purple-600 mr-2"></i>
                                        Kontak dan Identitas
                                    </h3>
                                    <div class="space-y-1">
                                        <div class="field-type bg-purple-50 border border-purple-200 rounded p-2 cursor-move hover:bg-purple-100 transition duration-200" data-type="email" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-envelope text-purple-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-purple-800">Email</span>
                                            </div>
                                        </div>

                                        <div class="field-type bg-purple-50 border border-purple-200 rounded p-2 cursor-move hover:bg-purple-100 transition duration-200" data-type="tel" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-phone text-purple-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-purple-800">Phone</span>
                                            </div>
                                        </div>

                                        <div class="field-type bg-purple-50 border border-purple-200 rounded p-2 cursor-move hover:bg-purple-100 transition duration-200" data-type="url" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-link text-purple-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-purple-800">URL</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 5. File dan Upload -->
                                <div class="field-category mb-4">
                                    <h3 class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-cloud-upload-alt text-red-600 mr-2"></i>
                                        File dan Upload
                                    </h3>
                                    <div class="space-y-1">
                                        <div class="field-type bg-red-50 border border-red-200 rounded p-2 cursor-move hover:bg-red-100 transition duration-200" data-type="file" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-file text-red-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-red-800">File Upload</span>
                                            </div>
                                        </div>

                                        <div class="field-type bg-red-50 border border-red-200 rounded p-2 cursor-move hover:bg-red-100 transition duration-200" data-type="image" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-image text-red-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-red-800">Image Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 6. Lokasi dan Lainnya -->
                                <div class="field-category mb-4">
                                    <h3 class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-map-marker-alt text-indigo-600 mr-2"></i>
                                        Lokasi dan Lainnya
                                    </h3>
                                    <div class="space-y-1">
                                        <div class="field-type bg-indigo-50 border border-indigo-200 rounded p-2 cursor-move hover:bg-indigo-100 transition duration-200" data-type="address" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-map-pin text-indigo-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-indigo-800">Address / Location</span>
                                            </div>
                                        </div>

                                        <div class="field-type bg-indigo-50 border border-indigo-200 rounded p-2 cursor-move hover:bg-indigo-100 transition duration-200" data-type="signature" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-signature text-indigo-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-indigo-800">Signature</span>
                                            </div>
                                        </div>

                                        <div class="field-type bg-indigo-50 border border-indigo-200 rounded p-2 cursor-move hover:bg-indigo-100 transition duration-200" data-type="rating" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-star text-indigo-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-indigo-800">Rating / Star</span>
                                            </div>
                                        </div>

                                        <div class="field-type bg-indigo-50 border border-indigo-200 rounded p-2 cursor-move hover:bg-indigo-100 transition duration-200" data-type="color" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-palette text-indigo-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-indigo-800">Color Picker</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 7. Struktur dan Logika Form -->
                                <div class="field-category mb-4">
                                    <h3 class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-sitemap text-gray-600 mr-2"></i>
                                        Struktur dan Logika Form
                                    </h3>
                                    <div class="space-y-1">
                                        <div class="field-type bg-gray-50 border border-gray-200 rounded p-2 cursor-move hover:bg-gray-100 transition duration-200" data-type="header" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-heading text-gray-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-gray-800">Heading / Label</span>
                                            </div>
                                        </div>

                                        <div class="field-type bg-gray-50 border border-gray-200 rounded p-2 cursor-move hover:bg-gray-100 transition duration-200" data-type="divider" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-minus text-gray-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-gray-800">Divider</span>
                                            </div>
                                        </div>

                                        <div class="field-type bg-gray-50 border border-gray-200 rounded p-2 cursor-move hover:bg-gray-100 transition duration-200" data-type="html" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-code text-gray-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-gray-800">HTML Block</span>
                                            </div>
                                        </div>

                                        <div class="field-type bg-gray-50 border border-gray-200 rounded p-2 cursor-move hover:bg-gray-100 transition duration-200" data-type="hidden" draggable="true">
                                            <div class="flex items-center">
                                                <i class="fas fa-eye-slash text-gray-600 mr-2 text-sm"></i>
                                                <span class="text-sm font-medium text-gray-800">Hidden Field</span>
                                            </div>
                                        </div>
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
                                            <p class="mt-2 text-lg font-medium">Click or drag field types here to build your form</p>
                                            <p class="text-sm mt-1">Select field types from the left panel and click them or drag them here</p>
                                            <div class="mt-4 flex justify-center space-x-4 text-xs text-gray-400">
                                                <span><i class="fas fa-hand-pointer mr-1"></i>Click to add</span>
                                                <span><i class="fas fa-arrows-alt mr-1"></i>Drag to add</span>
                                            </div>
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
