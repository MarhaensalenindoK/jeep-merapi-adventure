@props([
    'name',
    'placeholder' => 'Pilih...',
    'allowClear' => true,
    'options' => [],
    'selected' => null,
    'searchable' => true,
    'showDescription' => false,
    'class' => ''
])

@php
$selectClass = 'w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-admin-primary focus:border-admin-primary select2-field ' . $class;
$uniqueId = 'select2-' . Str::random(8);
@endphp

<select name="{{ $name }}"
        id="{{ $uniqueId }}"
        class="{{ $selectClass }}"
        {{ $attributes->except(['name', 'class']) }}>

    @if($placeholder && $allowClear)
        <option value="">{{ $placeholder }}</option>
    @endif

    @if(!empty($options))
        @foreach($options as $value => $option)
            @if(is_array($option))
                <option value="{{ $value }}"
                        @if($showDescription && isset($option['description'])) data-description="{{ $option['description'] }}" @endif
                        {{ (string)$selected === (string)$value ? 'selected' : '' }}>
                    {{ $option['name'] ?? $option['label'] ?? $value }}
                </option>
            @else
                <option value="{{ $value }}" {{ (string)$selected === (string)$value ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endif
        @endforeach
    @else
        {{ $slot }}
    @endif
</select>

@push('styles')
@once
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
/* Select2 Main Container */
.select2-container--default .select2-selection--single {
    height: 42px !important;
    border: 1px solid #d1d5db !important;
    border-radius: 0.5rem !important;
    display: flex !important;
    align-items: center !important;
    background-color: #ffffff !important;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
}

/* Selected Text */
.select2-container--default .select2-selection--single .select2-selection__rendered {
    padding-left: 16px !important;
    padding-right: 45px !important;
    color: #374151 !important;
    line-height: 40px !important;
    font-size: 14px !important;
}

/* Arrow */
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 40px !important;
    right: 12px !important;
    top: 1px !important;
}

/* Focus State */
.select2-container--default.select2-container--focus .select2-selection--single,
.select2-container--default .select2-selection--single:focus {
    border-color: #1e40af !important;
    box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1) !important;
    outline: none !important;
}

/* Dropdown Container */
.select2-dropdown {
    border: 1px solid #d1d5db !important;
    border-radius: 0.5rem !important;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
    background-color: #ffffff !important;
    z-index: 9999 !important;
}

/* Search Field */
.select2-search--dropdown {
    padding: 8px !important;
}

.select2-search--dropdown .select2-search__field {
    border: 1px solid #d1d5db !important;
    border-radius: 0.375rem !important;
    padding: 8px 12px !important;
    font-size: 14px !important;
    color: #374151 !important;
    background-color: #ffffff !important;
    width: 100% !important;
    box-sizing: border-box !important;
}

.select2-search--dropdown .select2-search__field:focus {
    border-color: #1e40af !important;
    box-shadow: 0 0 0 2px rgba(30, 64, 175, 0.1) !important;
    outline: none !important;
}

/* Results Container */
.select2-results {
    padding: 4px 0 !important;
}

.select2-results__options {
    max-height: 200px !important;
    overflow-y: auto !important;
}

/* Individual Options */
.select2-results__option {
    padding: 12px 16px !important;
    font-size: 14px !important;
    color: #374151 !important;
    background-color: #ffffff !important;
    cursor: pointer !important;
    border-bottom: 1px solid #f3f4f6 !important;
    transition: none !important;
}

.select2-results__option:last-child {
    border-bottom: none !important;
}

/* Highlighted Option (keyboard navigation) */
.select2-results__option--highlighted {
    background-color: #f8fafc !important;
    color: #1e40af !important;
}

/* Selected Option */
.select2-results__option[aria-selected="true"] {
    background-color: #eff6ff !important;
    color: #1e40af !important;
    font-weight: 500 !important;
}

/* No Results */
.select2-results__option--selectable {
    cursor: pointer !important;
}

.select2-results__message {
    padding: 12px 16px !important;
    color: #6b7280 !important;
    font-size: 14px !important;
    text-align: center !important;
}

/* Placeholder */
.select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #9ca3af !important;
    font-size: 14px !important;
}

/* Clear Button */
.select2-container--default .select2-selection__clear {
    cursor: pointer !important;
    float: right !important;
    font-weight: bold !important;
    margin-left: 10px !important;
    margin-right: 0px !important;
    color: #6b7280 !important;
}

.select2-container--default .select2-selection__clear:hover {
    color: #374151 !important;
}

/* Custom styling for our option template */
.select2-results__option .font-medium {
    font-weight: 500 !important;
    color: inherit !important;
}

.select2-results__option .text-sm.text-gray-500 {
    font-size: 12px !important;
    color: #6b7280 !important;
    margin-top: 2px !important;
    line-height: 1.3 !important;
}

/* Responsive adjustments */
@media (max-width: 640px) {
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-left: 12px !important;
        padding-right: 40px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        right: 8px !important;
    }

    .select2-results__option {
        padding: 10px 12px !important;
    }
}
</style>
@endonce
@endpush

@push('scripts')
@once
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
// Global Select2 initialization function
function initializeSelect2(selector, options = {}) {
    const defaultOptions = {
        allowClear: {{ $allowClear ? 'true' : 'false' }},
        width: '100%',
        @if($showDescription)
        templateResult: function(data) {
            if (!data.id) {
                return data.text;
            }

            var $option = $(data.element);
            var description = $option.data('description');

            var $result = $('<div></div>');
            $result.append('<div class="font-medium">' + data.text + '</div>');

            if (description) {
                $result.append('<div class="text-sm text-gray-500">' + description + '</div>');
            }

            return $result;
        },
        templateSelection: function(data) {
            return data.text;
        }
        @endif
    };

    const finalOptions = Object.assign(defaultOptions, options);

    if (finalOptions.placeholder) {
        finalOptions.placeholder = finalOptions.placeholder;
    }

    $(selector).select2(finalOptions);
}
</script>
@endonce

<script>
$(document).ready(function() {
    // Store the current selected value before initializing
    var currentValue = $('#{{ $uniqueId }}').val();
    var selectedValue = '{{ $selected }}';

    initializeSelect2('#{{ $uniqueId }}', {
        placeholder: '{{ $placeholder }}',
        @if(!$searchable)
        minimumResultsForSearch: Infinity,
        @endif
    });

    // Set the selected value explicitly after initialization
    if (selectedValue) {
        $('#{{ $uniqueId }}').val(selectedValue).trigger('change');
    } else if (currentValue) {
        $('#{{ $uniqueId }}').val(currentValue).trigger('change');
    }
});
</script>
@endpush
