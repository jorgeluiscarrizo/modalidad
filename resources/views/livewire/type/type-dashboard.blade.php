<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Lista de Tipos' }}
        </div>
    </x-slot>

    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="w-full flex justify-end space-x-2">
            <a href="{{ route('type.create') }}"
                class="my-2 border-2 border-green-500 text-green-500 bg-white flex items-center rounded-full hover:bg-green-500 hover:text-white">
                <svg class="w-8 h-8 m-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        <livewire:type.type-data-table />
    </div>
</div>
