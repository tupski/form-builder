// Form Builder JavaScript
let selectedField = null;
let sortable = null;
let conditionalRules = [];
let ruleCounter = 0;

function initializeFormBuilder() {
    // Initialize tabs
    initializeTabs();
    // Initialize drag and drop for field types
    const fieldTypes = document.getElementById('field-types');
    const formFields = document.getElementById('form-fields');
    const dropZone = document.getElementById('drop-zone');

    // Make field types draggable
    new Sortable(fieldTypes, {
        group: {
            name: 'shared',
            pull: 'clone',
            put: false
        },
        sort: false,
        onEnd: function(evt) {
            if (evt.to === formFields) {
                const fieldType = evt.item.dataset.type;
                addField(fieldType);
                evt.item.remove(); // Remove the cloned item
            }
        }
    });

    // Make form fields sortable
    sortable = new Sortable(formFields, {
        group: 'shared',
        animation: 150,
        onAdd: function(evt) {
            const fieldType = evt.item.dataset.type;
            addField(fieldType);
            evt.item.remove();
        },
        onEnd: function(evt) {
            updateFieldOrder();
        }
    });

    // Save form button
    document.getElementById('save-form').addEventListener('click', saveForm);

    // Save conditions button
    document.getElementById('save-conditions').addEventListener('click', saveConditionalRules);

    // Add condition button
    document.getElementById('add-condition').addEventListener('click', addConditionalRule);
}

function initializeTabs() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabName = this.dataset.tab;

            // Remove active class from all buttons
            tabButtons.forEach(btn => {
                btn.classList.remove('active', 'text-blue-600', 'border-blue-600');
                btn.classList.add('text-gray-500');
            });

            // Add active class to clicked button
            this.classList.add('active', 'text-blue-600', 'border-blue-600');
            this.classList.remove('text-gray-500');

            // Hide all tab contents
            tabContents.forEach(content => content.classList.add('hidden'));

            // Show selected tab content
            document.getElementById(tabName + '-tab').classList.remove('hidden');

            // Update title and buttons
            if (tabName === 'fields') {
                document.getElementById('tab-title').textContent = 'Form Fields';
                document.getElementById('save-form').classList.remove('hidden');
                document.getElementById('save-conditions').classList.add('hidden');
            } else if (tabName === 'conditions') {
                document.getElementById('tab-title').textContent = 'Conditional Logic';
                document.getElementById('save-form').classList.add('hidden');
                document.getElementById('save-conditions').classList.remove('hidden');
            }
        });
    });
}

function addField(type) {
    fieldCounter++;
    const fieldId = `field_${fieldCounter}`;
    const fieldName = `field_${fieldCounter}`;

    const fieldHtml = createFieldHtml(fieldId, type, fieldName);

    // Hide empty state
    document.getElementById('empty-state').style.display = 'none';

    // Add field to form
    const formFields = document.getElementById('form-fields');
    formFields.insertAdjacentHTML('beforeend', fieldHtml);

    // Add event listeners to the new field
    addFieldEventListeners(fieldId);
}

function createFieldHtml(fieldId, type, fieldName) {
    const fieldConfig = getFieldConfig(type);

    return `
        <div class="form-field bg-white border border-gray-300 rounded-lg p-4 mb-4 cursor-pointer hover:border-blue-500"
             data-field-id="${fieldId}" data-type="${type}" data-name="${fieldName}">
            <div class="flex justify-between items-start mb-2">
                <div class="flex items-center">
                    <span class="drag-handle cursor-move mr-2">⋮⋮</span>
                    <h4 class="font-medium">${fieldConfig.label}</h4>
                </div>
                <div class="flex space-x-2">
                    <button class="edit-field text-blue-600 hover:text-blue-800" title="Edit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <button class="delete-field text-red-600 hover:text-red-800" title="Delete">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="field-preview">
                ${createFieldPreview(type, fieldName, fieldConfig.label)}
            </div>
        </div>
    `;
}

function createFieldPreview(type, name, label) {
    switch(type) {
        case 'text':
        case 'email':
        case 'number':
            return `
                <label class="block text-sm font-medium text-gray-700 mb-1">${label}</label>
                <input type="${type}" name="${name}" class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="Enter ${label.toLowerCase()}" disabled>
            `;
        case 'textarea':
            return `
                <label class="block text-sm font-medium text-gray-700 mb-1">${label}</label>
                <textarea name="${name}" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="Enter ${label.toLowerCase()}" disabled></textarea>
            `;
        case 'select':
            return `
                <label class="block text-sm font-medium text-gray-700 mb-1">${label}</label>
                <select name="${name}" class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled>
                    <option>Option 1</option>
                    <option>Option 2</option>
                </select>
            `;
        case 'radio':
            return `
                <label class="block text-sm font-medium text-gray-700 mb-2">${label}</label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="radio" name="${name}" value="option1" class="mr-2" disabled>
                        <span>Option 1</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="${name}" value="option2" class="mr-2" disabled>
                        <span>Option 2</span>
                    </label>
                </div>
            `;
        case 'checkbox':
            return `
                <label class="block text-sm font-medium text-gray-700 mb-2">${label}</label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="${name}[]" value="option1" class="mr-2" disabled>
                        <span>Option 1</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="${name}[]" value="option2" class="mr-2" disabled>
                        <span>Option 2</span>
                    </label>
                </div>
            `;
        case 'date':
            return `
                <label class="block text-sm font-medium text-gray-700 mb-1">${label}</label>
                <input type="date" name="${name}" class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled>
            `;
        default:
            return `<p>Unknown field type: ${type}</p>`;
    }
}

function getFieldConfig(type) {
    const configs = {
        'text': { label: 'Text Input', icon: '📝' },
        'email': { label: 'Email', icon: '📧' },
        'number': { label: 'Number', icon: '🔢' },
        'textarea': { label: 'Textarea', icon: '📄' },
        'select': { label: 'Select Dropdown', icon: '📋' },
        'radio': { label: 'Radio Buttons', icon: '🔘' },
        'checkbox': { label: 'Checkboxes', icon: '☑️' },
        'date': { label: 'Date', icon: '📅' }
    };
    return configs[type] || { label: 'Unknown', icon: '❓' };
}

function addFieldEventListeners(fieldId) {
    const fieldElement = document.querySelector(`[data-field-id="${fieldId}"]`);

    // Edit field
    fieldElement.querySelector('.edit-field').addEventListener('click', function(e) {
        e.stopPropagation();
        editField(fieldId);
    });

    // Delete field
    fieldElement.querySelector('.delete-field').addEventListener('click', function(e) {
        e.stopPropagation();
        deleteField(fieldId);
    });

    // Select field
    fieldElement.addEventListener('click', function() {
        selectField(fieldId);
    });
}

function editField(fieldId) {
    selectField(fieldId);
    // Additional edit functionality will be added here
}

function deleteField(fieldId) {
    if (confirm('Are you sure you want to delete this field?')) {
        const fieldElement = document.querySelector(`[data-field-id="${fieldId}"]`);
        fieldElement.remove();

        // Show empty state if no fields left
        const formFields = document.getElementById('form-fields');
        if (formFields.children.length === 0) {
            document.getElementById('empty-state').style.display = 'block';
        }

        // Clear properties panel if this field was selected
        if (selectedField === fieldId) {
            selectedField = null;
            showFieldProperties(null);
        }
    }
}

function selectField(fieldId) {
    // Remove previous selection
    document.querySelectorAll('.form-field').forEach(field => {
        field.classList.remove('ring-2', 'ring-blue-500');
    });

    // Add selection to current field
    const fieldElement = document.querySelector(`[data-field-id="${fieldId}"]`);
    fieldElement.classList.add('ring-2', 'ring-blue-500');

    selectedField = fieldId;
    showFieldProperties(fieldId);
}

function showFieldProperties(fieldId) {
    const propertiesPanel = document.getElementById('field-properties');

    if (!fieldId) {
        propertiesPanel.innerHTML = '<p class="text-gray-500 text-center">Select a field to edit its properties</p>';
        return;
    }

    const fieldElement = document.querySelector(`[data-field-id="${fieldId}"]`);
    const fieldType = fieldElement.dataset.type;
    const fieldName = fieldElement.dataset.name;

    // Create properties form (simplified version)
    propertiesPanel.innerHTML = `
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Field Label</label>
                <input type="text" id="field-label" value="${getFieldConfig(fieldType).label}" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Field Name</label>
                <input type="text" id="field-name" value="${fieldName}" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
            </div>
            <div>
                <label class="flex items-center">
                    <input type="checkbox" id="field-required" class="mr-2">
                    <span class="text-sm">Required field</span>
                </label>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Placeholder</label>
                <input type="text" id="field-placeholder" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
            </div>
            <button onclick="updateFieldProperties('${fieldId}')" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                Update Field
            </button>
        </div>
    `;
}

function updateFieldProperties(fieldId) {
    const label = document.getElementById('field-label').value;
    const name = document.getElementById('field-name').value;
    const required = document.getElementById('field-required').checked;
    const placeholder = document.getElementById('field-placeholder').value;

    const fieldElement = document.querySelector(`[data-field-id="${fieldId}"]`);
    fieldElement.dataset.name = name;

    // Update the field preview
    const fieldType = fieldElement.dataset.type;
    const preview = fieldElement.querySelector('.field-preview');
    preview.innerHTML = createFieldPreview(fieldType, name, label);

    // Update the field title
    fieldElement.querySelector('h4').textContent = label;

    showMessage('Field updated successfully!', 'success');
}

function updateFieldOrder() {
    // This function will be called when fields are reordered
    // Implementation for updating field order
}

function loadExistingFields() {
    if (formFields && formFields.length > 0) {
        document.getElementById('empty-state').style.display = 'none';

        formFields.forEach((field, index) => {
            const fieldHtml = createFieldHtml(`existing_${field.id}`, field.type, field.name);
            document.getElementById('form-fields').insertAdjacentHTML('beforeend', fieldHtml);
            addFieldEventListeners(`existing_${field.id}`);
        });
    }
}

function saveForm() {
    const fields = [];
    const fieldElements = document.querySelectorAll('.form-field');

    fieldElements.forEach((element, index) => {
        const fieldData = {
            type: element.dataset.type,
            name: element.dataset.name,
            label: element.querySelector('h4').textContent,
            order: index,
            required: false, // This would be determined from the properties
            placeholder: '', // This would be determined from the properties
            options: null,
            settings: null
        };
        fields.push(fieldData);
    });

    // Send AJAX request to save fields
    fetch(`/forms/${window.location.pathname.split('/')[2]}/fields`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ fields: fields })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showMessage(data.message, 'success');
        } else {
            showMessage('Error saving form', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showMessage('Error saving form', 'error');
    });
}

function showMessage(message, type) {
    const successDiv = document.getElementById('success-message');
    const errorDiv = document.getElementById('error-message');

    // Hide both messages first
    successDiv.classList.add('hidden');
    errorDiv.classList.add('hidden');

    if (type === 'success') {
        document.getElementById('success-text').textContent = message;
        successDiv.classList.remove('hidden');
        setTimeout(() => successDiv.classList.add('hidden'), 5000);
    } else {
        document.getElementById('error-text').textContent = message;
        errorDiv.classList.remove('hidden');
        setTimeout(() => errorDiv.classList.add('hidden'), 5000);
    }
}

// Conditional Logic Functions
function addConditionalRule() {
    const formFields = document.querySelectorAll('.form-field');
    if (formFields.length < 2) {
        showMessage('You need at least 2 fields to create conditional rules', 'error');
        return;
    }

    ruleCounter++;
    const ruleId = `rule_${ruleCounter}`;

    const ruleHtml = createConditionalRuleHtml(ruleId);

    // Hide no conditions message
    document.getElementById('no-conditions').style.display = 'none';

    // Add rule to container
    const rulesContainer = document.getElementById('conditional-rules');
    rulesContainer.insertAdjacentHTML('beforeend', ruleHtml);

    // Populate field options
    populateFieldOptions(ruleId);

    // Add event listeners
    addRuleEventListeners(ruleId);
}

function createConditionalRuleHtml(ruleId) {
    return `
        <div class="conditional-rule bg-gray-50 border border-gray-200 rounded-lg p-4 mb-4" data-rule-id="${ruleId}">
            <div class="flex justify-between items-start mb-4">
                <h4 class="font-medium text-gray-900">Conditional Rule</h4>
                <button class="delete-rule text-red-600 hover:text-red-800" title="Delete Rule">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Action</label>
                    <select class="rule-action w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                        <option value="show">Show</option>
                        <option value="hide">Hide</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Target Field</label>
                    <select class="rule-target-field w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                        <option value="">Select field...</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">When</label>
                    <select class="rule-condition-field w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                        <option value="">Select field...</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Operator</label>
                    <select class="rule-operator w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                        <option value="equals">Equals</option>
                        <option value="not_equals">Not Equals</option>
                        <option value="contains">Contains</option>
                        <option value="not_contains">Not Contains</option>
                        <option value="greater_than">Greater Than</option>
                        <option value="less_than">Less Than</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Value</label>
                    <input type="text" class="rule-value w-full px-3 py-2 border border-gray-300 rounded-md text-sm" placeholder="Enter value">
                </div>
            </div>
        </div>
    `;
}

function populateFieldOptions(ruleId) {
    const formFields = document.querySelectorAll('.form-field');
    const ruleElement = document.querySelector(`[data-rule-id="${ruleId}"]`);
    const targetSelect = ruleElement.querySelector('.rule-target-field');
    const conditionSelect = ruleElement.querySelector('.rule-condition-field');

    // Clear existing options
    targetSelect.innerHTML = '<option value="">Select field...</option>';
    conditionSelect.innerHTML = '<option value="">Select field...</option>';

    // Add field options
    formFields.forEach(field => {
        const fieldId = field.dataset.fieldId;
        const fieldName = field.dataset.name;
        const fieldLabel = field.querySelector('h4').textContent;

        const option1 = new Option(`${fieldLabel} (${fieldName})`, fieldId);
        const option2 = new Option(`${fieldLabel} (${fieldName})`, fieldId);

        targetSelect.add(option1);
        conditionSelect.add(option2);
    });
}

function addRuleEventListeners(ruleId) {
    const ruleElement = document.querySelector(`[data-rule-id="${ruleId}"]`);

    // Delete rule button
    ruleElement.querySelector('.delete-rule').addEventListener('click', function() {
        deleteConditionalRule(ruleId);
    });
}

function deleteConditionalRule(ruleId) {
    if (confirm('Are you sure you want to delete this conditional rule?')) {
        const ruleElement = document.querySelector(`[data-rule-id="${ruleId}"]`);
        ruleElement.remove();

        // Show no conditions message if no rules left
        const rulesContainer = document.getElementById('conditional-rules');
        if (rulesContainer.children.length === 1) { // Only the no-conditions div
            document.getElementById('no-conditions').style.display = 'block';
        }
    }
}

function saveConditionalRules() {
    const rules = [];
    const ruleElements = document.querySelectorAll('.conditional-rule');

    ruleElements.forEach(element => {
        const targetFieldId = element.querySelector('.rule-target-field').value;
        const conditionFieldId = element.querySelector('.rule-condition-field').value;
        const operator = element.querySelector('.rule-operator').value;
        const conditionValue = element.querySelector('.rule-value').value;
        const action = element.querySelector('.rule-action').value;

        if (targetFieldId && conditionFieldId && conditionValue) {
            rules.push({
                target_field_id: targetFieldId,
                condition_field_id: conditionFieldId,
                operator: operator,
                condition_value: conditionValue,
                action: action
            });
        }
    });

    // Send AJAX request to save conditional rules
    fetch(`/forms/${window.location.pathname.split('/')[2]}/conditional-rules`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ rules: rules })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showMessage(data.message, 'success');
        } else {
            showMessage('Error saving conditional rules', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showMessage('Error saving conditional rules', 'error');
    });
}
