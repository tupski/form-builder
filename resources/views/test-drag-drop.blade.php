<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag & Drop Test - Form Builder</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-4">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Drag & Drop Test</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Field Types Palette -->
            <div class="bg-white rounded-lg shadow-lg p-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Field Types</h2>
                <div class="space-y-3 max-h-96 overflow-y-auto" id="field-types">
                    <!-- 1. Field Teks -->
                    <div class="field-category">
                        <h4 class="text-xs font-semibold text-gray-600 mb-1 flex items-center">
                            <i class="fas fa-font text-blue-600 mr-1"></i>
                            Field Teks
                        </h4>
                        <div class="space-y-1">
                            <div class="field-type bg-blue-50 border border-blue-200 rounded p-2 cursor-move hover:bg-blue-100 transition duration-200" data-type="text" draggable="true">
                                <div class="flex items-center">
                                    <i class="fas fa-i-cursor text-blue-600 mr-2 text-xs"></i>
                                    <span class="text-xs font-medium text-blue-800">Single Line Text</span>
                                </div>
                            </div>
                            <div class="field-type bg-blue-50 border border-blue-200 rounded p-2 cursor-move hover:bg-blue-100 transition duration-200" data-type="textarea" draggable="true">
                                <div class="flex items-center">
                                    <i class="fas fa-align-left text-blue-600 mr-2 text-xs"></i>
                                    <span class="text-xs font-medium text-blue-800">Paragraph Text</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Angka dan Pilihan -->
                    <div class="field-category">
                        <h4 class="text-xs font-semibold text-gray-600 mb-1 flex items-center">
                            <i class="fas fa-list-ol text-green-600 mr-1"></i>
                            Angka & Pilihan
                        </h4>
                        <div class="space-y-1">
                            <div class="field-type bg-green-50 border border-green-200 rounded p-2 cursor-move hover:bg-green-100 transition duration-200" data-type="number" draggable="true">
                                <div class="flex items-center">
                                    <i class="fas fa-hashtag text-green-600 mr-2 text-xs"></i>
                                    <span class="text-xs font-medium text-green-800">Number</span>
                                </div>
                            </div>
                            <div class="field-type bg-green-50 border border-green-200 rounded p-2 cursor-move hover:bg-green-100 transition duration-200" data-type="select" draggable="true">
                                <div class="flex items-center">
                                    <i class="fas fa-chevron-down text-green-600 mr-2 text-xs"></i>
                                    <span class="text-xs font-medium text-green-800">Dropdown</span>
                                </div>
                            </div>
                            <div class="field-type bg-green-50 border border-green-200 rounded p-2 cursor-move hover:bg-green-100 transition duration-200" data-type="radio" draggable="true">
                                <div class="flex items-center">
                                    <i class="fas fa-dot-circle text-green-600 mr-2 text-xs"></i>
                                    <span class="text-xs font-medium text-green-800">Radio Button</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Kontak -->
                    <div class="field-category">
                        <h4 class="text-xs font-semibold text-gray-600 mb-1 flex items-center">
                            <i class="fas fa-address-card text-purple-600 mr-1"></i>
                            Kontak
                        </h4>
                        <div class="space-y-1">
                            <div class="field-type bg-purple-50 border border-purple-200 rounded p-2 cursor-move hover:bg-purple-100 transition duration-200" data-type="email" draggable="true">
                                <div class="flex items-center">
                                    <i class="fas fa-envelope text-purple-600 mr-2 text-xs"></i>
                                    <span class="text-xs font-medium text-purple-800">Email</span>
                                </div>
                            </div>
                            <div class="field-type bg-purple-50 border border-purple-200 rounded p-2 cursor-move hover:bg-purple-100 transition duration-200" data-type="tel" draggable="true">
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-purple-600 mr-2 text-xs"></i>
                                    <span class="text-xs font-medium text-purple-800">Phone</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Builder Area -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-lg p-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Form Builder</h2>

                <!-- Drop Zone -->
                <div id="drop-zone" class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center text-gray-500 min-h-[400px]">
                    <div id="empty-state">
                        <i class="fas fa-mouse-pointer text-4xl text-gray-400 mb-4"></i>
                        <p class="text-lg font-medium">Drag fields here to build your form</p>
                        <p class="text-sm">Select field types from the left panel and drag them here</p>
                    </div>

                    <!-- Form Fields Container -->
                    <div id="form-fields" class="space-y-4"></div>
                </div>
            </div>
        </div>

        <!-- Debug Info -->
        <div class="mt-6 bg-white rounded-lg shadow-lg p-4">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Debug Info</h3>
            <div id="debug-info" class="text-sm text-gray-600">
                <p>Drag and drop events will appear here...</p>
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('landing') }}" class="text-blue-600 hover:text-blue-800 underline">
                ← Back to Landing Page
            </a>
        </div>
    </div>

    <!-- SortableJS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        let fieldCounter = 0;

        document.addEventListener('DOMContentLoaded', function() {
            console.log('Initializing drag and drop test...');

            const fieldTypes = document.getElementById('field-types');
            const formFields = document.getElementById('form-fields');
            const dropZone = document.getElementById('drop-zone');
            const emptyState = document.getElementById('empty-state');
            const debugInfo = document.getElementById('debug-info');

            function addDebugMessage(message) {
                const timestamp = new Date().toLocaleTimeString();
                debugInfo.innerHTML += `<p>[${timestamp}] ${message}</p>`;
                debugInfo.scrollTop = debugInfo.scrollHeight;
            }

            if (!fieldTypes || !formFields || !dropZone) {
                addDebugMessage('❌ Required elements not found!');
                return;
            }

            addDebugMessage('✅ Elements found, initializing interactions...');

            // Add click functionality to field types (PRIMARY METHOD)
            const fieldTypeElements = fieldTypes.querySelectorAll('.field-type');
            fieldTypeElements.forEach(function(element) {
                // Add click event
                element.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const fieldType = this.getAttribute('data-type');
                    addDebugMessage(`👆 Field type clicked: ${fieldType}`);
                    if (fieldType) {
                        addField(fieldType);
                        hideEmptyState();
                        // Add visual feedback
                        this.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            this.style.transform = '';
                        }, 150);
                    }
                });

                // Add hover effect
                element.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                    this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
                });

                element.addEventListener('mouseleave', function() {
                    this.style.transform = '';
                    this.style.boxShadow = '';
                });
            });

            addDebugMessage('✅ Click functionality added to all field types');

            // Make field types draggable (BACKUP METHOD)
            try {
                const fieldTypeSortable = new Sortable(fieldTypes, {
                    group: {
                        name: 'formBuilder',
                        pull: 'clone',
                        put: false
                    },
                    sort: false,
                    animation: 150,
                    ghostClass: 'sortable-ghost',
                    chosenClass: 'sortable-chosen',
                    dragClass: 'sortable-drag',
                    onStart: function(evt) {
                        const fieldType = evt.item.getAttribute('data-type');
                        addDebugMessage(`🚀 Drag started: ${fieldType}`);
                        evt.item.classList.add('dragging');
                        dropZone.classList.add('drag-over');
                        document.body.classList.add('dragging-field');
                    },
                    onEnd: function(evt) {
                        addDebugMessage('🏁 Drag ended');
                        evt.item.classList.remove('dragging');
                        dropZone.classList.remove('drag-over');
                        document.body.classList.remove('dragging-field');
                    }
                });
                addDebugMessage('✅ Drag and drop initialized as backup');
            } catch (error) {
                addDebugMessage('⚠️ Drag and drop not available, using click only');
            }

            // Make form fields sortable (for reordering existing fields)
            try {
                const formFieldsSortable = new Sortable(formFields, {
                    group: {
                        name: 'formBuilder',
                        pull: true,
                        put: true
                    },
                    animation: 150,
                    ghostClass: 'sortable-ghost',
                    chosenClass: 'sortable-chosen',
                    dragClass: 'sortable-drag',
                    onAdd: function(evt) {
                        const fieldType = evt.item.getAttribute('data-type');
                        addDebugMessage(`➕ Field added via drag: ${fieldType}`);

                        if (fieldType) {
                            addField(fieldType);
                            evt.item.remove();
                            hideEmptyState();
                        }
                    },
                    onUpdate: function(evt) {
                        addDebugMessage('🔄 Field reordered');
                    },
                    onRemove: function(evt) {
                        addDebugMessage('➖ Field removed');
                        if (formFields.children.length === 0) {
                            showEmptyState();
                        }
                    }
                });
                addDebugMessage('✅ Form fields sortable initialized');
            } catch (error) {
                addDebugMessage('⚠️ Form fields sortable not available');
            }

            function addField(type) {
                fieldCounter++;
                const fieldId = `field_${fieldCounter}`;
                const fieldName = `field_${fieldCounter}`;
                const config = getFieldConfig(type);

                const fieldHtml = `
                    <div class="form-field bg-white border border-gray-300 rounded-lg p-4 mb-4" data-field-id="${fieldId}" data-type="${type}">
                        <div class="flex justify-between items-start mb-2">
                            <h4 class="font-medium text-gray-800">${config.icon} ${config.label}</h4>
                            <button class="text-red-500 hover:text-red-700 text-sm" onclick="removeField('${fieldId}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div class="field-preview">
                            ${createFieldPreview(type, fieldName, config.label)}
                        </div>
                    </div>
                `;

                formFields.insertAdjacentHTML('beforeend', fieldHtml);
                addDebugMessage(`✨ Field created: ${config.label} (${fieldId})`);
            }

            function hideEmptyState() {
                if (emptyState) {
                    emptyState.style.display = 'none';
                }
            }

            function showEmptyState() {
                if (emptyState && formFields.children.length === 0) {
                    emptyState.style.display = 'block';
                }
            }

            // Global function for removing fields
            window.removeField = function(fieldId) {
                const fieldElement = document.querySelector(`[data-field-id="${fieldId}"]`);
                if (fieldElement) {
                    fieldElement.remove();
                    addDebugMessage(`🗑️ Field removed: ${fieldId}`);
                    if (formFields.children.length === 0) {
                        showEmptyState();
                    }
                }
            };

            function getFieldConfig(type) {
                const configs = {
                    'text': { label: 'Text Input', icon: '📝' },
                    'email': { label: 'Email', icon: '📧' },
                    'textarea': { label: 'Textarea', icon: '📄' },
                    'select': { label: 'Select', icon: '📋' },
                    'radio': { label: 'Radio', icon: '🔘' },
                    'checkbox': { label: 'Checkbox', icon: '☑️' },
                    'date': { label: 'Date', icon: '📅' },
                    'header': { label: 'Header', icon: '📰' },
                    'rating': { label: 'Rating', icon: '⭐' },
                    'captcha': { label: 'Captcha', icon: '🛡️' }
                };
                return configs[type] || { label: 'Unknown', icon: '❓' };
            }

            function createFieldPreview(type, name, label) {
                switch(type) {
                    case 'text':
                    case 'email':
                        return `
                            <label class="block text-sm font-medium text-gray-700 mb-1">${label}</label>
                            <input type="${type}" name="${name}" class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled>
                        `;
                    case 'textarea':
                        return `
                            <label class="block text-sm font-medium text-gray-700 mb-1">${label}</label>
                            <textarea name="${name}" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled></textarea>
                        `;
                    case 'select':
                        return `
                            <label class="block text-sm font-medium text-gray-700 mb-1">${label}</label>
                            <select name="${name}" class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled>
                                <option>Option 1</option>
                                <option>Option 2</option>
                            </select>
                        `;
                    case 'header':
                        return `<h2 class="text-xl font-bold text-gray-800 mb-2">${label}</h2>`;
                    case 'rating':
                        return `
                            <label class="block text-sm font-medium text-gray-700 mb-2">${label}</label>
                            <div class="flex space-x-1">
                                <span class="text-yellow-400 text-xl">★</span>
                                <span class="text-yellow-400 text-xl">★</span>
                                <span class="text-yellow-400 text-xl">★</span>
                                <span class="text-gray-300 text-xl">★</span>
                                <span class="text-gray-300 text-xl">★</span>
                            </div>
                        `;
                    case 'captcha':
                        return `
                            <label class="block text-sm font-medium text-gray-700 mb-2">${label}</label>
                            <div class="bg-gray-100 border border-gray-300 rounded p-4 text-center">
                                <span class="text-gray-500">🛡️ Captcha Verification</span>
                            </div>
                        `;
                    default:
                        return `<p class="text-gray-500">Preview for ${type}</p>`;
                }
            }

            addDebugMessage('🎉 Drag and drop test initialized successfully!');
        });
    </script>
</body>
</html>
