<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $form->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $form->title }}</h1>
                        @if($form->description)
                            <p class="text-gray-600">{{ $form->description }}</p>
                        @endif
                    </div>

                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('form.submit', $form->slug) }}" method="POST" id="public-form">
                        @csrf
                        
                        <div class="space-y-6">
                            @foreach($form->fields as $field)
                                <div class="form-field" data-field-id="{{ $field->id }}" data-field-name="{{ $field->name }}">
                                    @switch($field->type)
                                        @case('text')
                                        @case('email')
                                        @case('number')
                                            <div>
                                                <label for="{{ $field->name }}" class="block text-sm font-medium text-gray-700 mb-1">
                                                    {{ $field->label }}
                                                    @if($field->required)
                                                        <span class="text-red-500">*</span>
                                                    @endif
                                                </label>
                                                <input type="{{ $field->type }}" 
                                                       name="{{ $field->name }}" 
                                                       id="{{ $field->name }}"
                                                       value="{{ old($field->name) }}"
                                                       placeholder="{{ $field->placeholder }}"
                                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                       {{ $field->required ? 'required' : '' }}>
                                                @if($field->help_text)
                                                    <p class="mt-1 text-sm text-gray-500">{{ $field->help_text }}</p>
                                                @endif
                                            </div>
                                            @break

                                        @case('textarea')
                                            <div>
                                                <label for="{{ $field->name }}" class="block text-sm font-medium text-gray-700 mb-1">
                                                    {{ $field->label }}
                                                    @if($field->required)
                                                        <span class="text-red-500">*</span>
                                                    @endif
                                                </label>
                                                <textarea name="{{ $field->name }}" 
                                                          id="{{ $field->name }}"
                                                          rows="4"
                                                          placeholder="{{ $field->placeholder }}"
                                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                          {{ $field->required ? 'required' : '' }}>{{ old($field->name) }}</textarea>
                                                @if($field->help_text)
                                                    <p class="mt-1 text-sm text-gray-500">{{ $field->help_text }}</p>
                                                @endif
                                            </div>
                                            @break

                                        @case('select')
                                            <div>
                                                <label for="{{ $field->name }}" class="block text-sm font-medium text-gray-700 mb-1">
                                                    {{ $field->label }}
                                                    @if($field->required)
                                                        <span class="text-red-500">*</span>
                                                    @endif
                                                </label>
                                                <select name="{{ $field->name }}" 
                                                        id="{{ $field->name }}"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                        {{ $field->required ? 'required' : '' }}>
                                                    <option value="">Choose an option</option>
                                                    @if($field->options)
                                                        @foreach($field->options as $option)
                                                            <option value="{{ $option }}" {{ old($field->name) == $option ? 'selected' : '' }}>
                                                                {{ $option }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="option1">Option 1</option>
                                                        <option value="option2">Option 2</option>
                                                    @endif
                                                </select>
                                                @if($field->help_text)
                                                    <p class="mt-1 text-sm text-gray-500">{{ $field->help_text }}</p>
                                                @endif
                                            </div>
                                            @break

                                        @case('radio')
                                            <div>
                                                <fieldset>
                                                    <legend class="block text-sm font-medium text-gray-700 mb-2">
                                                        {{ $field->label }}
                                                        @if($field->required)
                                                            <span class="text-red-500">*</span>
                                                        @endif
                                                    </legend>
                                                    <div class="space-y-2">
                                                        @if($field->options)
                                                            @foreach($field->options as $option)
                                                                <label class="flex items-center">
                                                                    <input type="radio" 
                                                                           name="{{ $field->name }}" 
                                                                           value="{{ $option }}"
                                                                           {{ old($field->name) == $option ? 'checked' : '' }}
                                                                           class="mr-2 text-blue-600 focus:ring-blue-500"
                                                                           {{ $field->required ? 'required' : '' }}>
                                                                    <span>{{ $option }}</span>
                                                                </label>
                                                            @endforeach
                                                        @else
                                                            <label class="flex items-center">
                                                                <input type="radio" name="{{ $field->name }}" value="option1" class="mr-2" {{ $field->required ? 'required' : '' }}>
                                                                <span>Option 1</span>
                                                            </label>
                                                            <label class="flex items-center">
                                                                <input type="radio" name="{{ $field->name }}" value="option2" class="mr-2" {{ $field->required ? 'required' : '' }}>
                                                                <span>Option 2</span>
                                                            </label>
                                                        @endif
                                                    </div>
                                                </fieldset>
                                                @if($field->help_text)
                                                    <p class="mt-1 text-sm text-gray-500">{{ $field->help_text }}</p>
                                                @endif
                                            </div>
                                            @break

                                        @case('checkbox')
                                            <div>
                                                <fieldset>
                                                    <legend class="block text-sm font-medium text-gray-700 mb-2">
                                                        {{ $field->label }}
                                                        @if($field->required)
                                                            <span class="text-red-500">*</span>
                                                        @endif
                                                    </legend>
                                                    <div class="space-y-2">
                                                        @if($field->options)
                                                            @foreach($field->options as $option)
                                                                <label class="flex items-center">
                                                                    <input type="checkbox" 
                                                                           name="{{ $field->name }}[]" 
                                                                           value="{{ $option }}"
                                                                           {{ in_array($option, old($field->name, [])) ? 'checked' : '' }}
                                                                           class="mr-2 text-blue-600 focus:ring-blue-500">
                                                                    <span>{{ $option }}</span>
                                                                </label>
                                                            @endforeach
                                                        @else
                                                            <label class="flex items-center">
                                                                <input type="checkbox" name="{{ $field->name }}[]" value="option1" class="mr-2">
                                                                <span>Option 1</span>
                                                            </label>
                                                            <label class="flex items-center">
                                                                <input type="checkbox" name="{{ $field->name }}[]" value="option2" class="mr-2">
                                                                <span>Option 2</span>
                                                            </label>
                                                        @endif
                                                    </div>
                                                </fieldset>
                                                @if($field->help_text)
                                                    <p class="mt-1 text-sm text-gray-500">{{ $field->help_text }}</p>
                                                @endif
                                            </div>
                                            @break

                                        @case('date')
                                            <div>
                                                <label for="{{ $field->name }}" class="block text-sm font-medium text-gray-700 mb-1">
                                                    {{ $field->label }}
                                                    @if($field->required)
                                                        <span class="text-red-500">*</span>
                                                    @endif
                                                </label>
                                                <input type="date" 
                                                       name="{{ $field->name }}" 
                                                       id="{{ $field->name }}"
                                                       value="{{ old($field->name) }}"
                                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                       {{ $field->required ? 'required' : '' }}>
                                                @if($field->help_text)
                                                    <p class="mt-1 text-sm text-gray-500">{{ $field->help_text }}</p>
                                                @endif
                                            </div>
                                            @break
                                    @endswitch
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-8">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-md transition duration-200">
                                Submit Form
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Conditional Logic Script -->
    @if($form->conditionalRules->count() > 0)
    <script>
        const conditionalRules = @json($form->conditionalRules);
        
        document.addEventListener('DOMContentLoaded', function() {
            // Apply conditional logic
            conditionalRules.forEach(rule => {
                const conditionField = document.querySelector(`[name="${rule.condition_field.name}"]`);
                const targetField = document.querySelector(`[data-field-id="${rule.target_field_id}"]`);
                
                if (conditionField && targetField) {
                    // Initial check
                    checkCondition(rule, conditionField, targetField);
                    
                    // Add event listener
                    conditionField.addEventListener('change', function() {
                        checkCondition(rule, conditionField, targetField);
                    });
                }
            });
        });
        
        function checkCondition(rule, conditionField, targetField) {
            const fieldValue = conditionField.value;
            let showField = false;
            
            switch(rule.operator) {
                case 'equals':
                    showField = fieldValue === rule.condition_value;
                    break;
                case 'not_equals':
                    showField = fieldValue !== rule.condition_value;
                    break;
                case 'contains':
                    showField = fieldValue.toLowerCase().includes(rule.condition_value.toLowerCase());
                    break;
                case 'not_contains':
                    showField = !fieldValue.toLowerCase().includes(rule.condition_value.toLowerCase());
                    break;
            }
            
            if (rule.action === 'hide') {
                showField = !showField;
            }
            
            targetField.style.display = showField ? 'block' : 'none';
        }
    </script>
    @endif
</body>
</html>
