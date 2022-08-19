<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Ciudad
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-card-component>

            @slot('content')
                <form wire:submit.prevent="submit" class="lg:m-10 p-4">
                    {{-- name --}}
                    <x-jet-label for="name"  />
                    <i class="fas fa-pencil-alt"> Nombre</i>
                    <x-jet-input city="text" placeholder="Nombre" wire:model="name" wire:keyup="generateSlug"
                        class="mt-1 block w-full rounded-fx" required />
                    @error('name')
                        <p class="text-red-500 font-semibold my-2">
                            {{ $message }}
                        </p>
                    @enderror
                    {{-- end name --}}
                   {{-- state --}}
                   <x-jet-label class="mt-4" for="state" />
                   <i class="fas fa-check-circle"> Estado</i>
                   <div class="mt-4 space-y-2">
                       <div class="flex items-center">
                           <input wire:model="state" value="ACTIVE" type="radio"
                               class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300">
                           <label for="push_everything" class="ml-2 block text-sm font-medium text-gray-700">
                               Activo
                           </label>
                       </div>
                       <div class="flex items-center">
                           <input wire:model="state" value="INACTIVE" type="radio"
                               class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300">
                           <label for="push_email" class="ml-2 block text-sm font-medium text-gray-700">
                               Inactivo
                           </label>
                       </div>
                   </div>
                   {{-- end state --}}

                    {{-- all errors --}}
                    @if ($errors->any())
                        <div class="bg-red-100 rounded-md text-red-500 p-2 font-semibold my-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- end all errors --}}

                    <x-jet-button city="submit" class="h-12 w-full rounded-fx flex items-center justify-center">
                        Guardar
                    </x-jet-button>

                </form>

            @endslot
        </x-card-component>
    </div>
</div>
