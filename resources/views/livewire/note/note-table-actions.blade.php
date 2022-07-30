<div class="flex space-x-1 justify-around">

    {{-- delet --}}
    <button wire:click="toastConfirmDelet('{{ $id }}')"
        class="p-1 text-red-600 hover:bg-red-600 hover:text-white rounded-full">
        <svg  class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
        </svg>
    </button>
    {{-- end delet --}}
</div>
