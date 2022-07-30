@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class=" static">
        {{ $content }}
        <div class="absolute right-0 top-0">
            {{ $close }}
        </div>
    </div>
</x-jet-modal>
