@constituent('laravel-building::partial.input', [
    'attributes' => $attributes ?? [],
    'class' => $class ?? [],
    'name' => $name,
    'tooltip' => $tooltip ?? '',
    'label' => $label ?? $name,
    'type' => 'select',
    'value' => $value ?? '',
    'values' => $values ?? []
])
