@props(['value'])

<div 
    class="rounded-md shadow-sm"
    wire:ignore 
    x-data="{ value: @entangle($attributes->wire('model')), isFocused: false }"
    x-init="
        $refs.trix.editor.loadHTML(value);
        $watch('value', () => {
            if (!isFocused) {
                $refs.trix.editor.loadHTML(value)
            }
        })
    "
    @trix-change="value = $event.target.value"
    @trix-focus="isFocused = true"
    @trix-blur="isFocused = false"
>
    <input id="x" type="hidden">
    <trix-editor 
        x-ref="trix" 
        input="x" 
        class="bg-white border-gray-300 focus:border-pesantren-primary focus:ring focus:ring-pesantren-primary focus:ring-opacity-50 rounded-md shadow-sm min-h-[300px]"
    ></trix-editor>
</div>