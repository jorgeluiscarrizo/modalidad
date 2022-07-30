<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar Meta
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-card-component>

            @slot('content')

                <form wire:submit.prevent="submit" class="lg:m-10 p-4">

                    {{-- date_i --}}
                    <x-jet-label for="date_i" value="Fecha Inicio" />
                    <x-jet-input type="date" placeholder="Fecha Inicio" wire:model="date_i"
                        class="mt-1 block w-full rounded-fx" required />
                    @error('date_i')
                        <p class="text-red-500 font-semibold my-2">
                            {{ $message }}
                        </p>
                    @enderror
                    {{-- end date_i --}}

                    {{-- date_f --}}
                    <x-jet-label for="date_f" value="Fecha final" />
                    <x-jet-input type="date" placeholder="Fecha final" wire:model="date_f"
                        class="mt-1 block w-full rounded-fx" required />
                    @error('date_f')
                        <p class="text-red-500 font-semibold my-2">
                            {{ $message }}
                        </p>
                    @enderror
                    {{-- end date_f --}}

                    {{-- amount --}}
                    <x-jet-label for="amount" value="Monto" />
                    <x-jet-input type="number" step="0.01" placeholder="Monto" wire:model="amount"
                        class="mt-1 block w-full rounded-fx" required />
                    @error('amount')
                        <p class="text-red-500 font-semibold my-2">
                            {{ $message }}
                        </p>
                    @enderror
                    {{-- end amount --}}

                    {{-- bonus --}}
                    <x-jet-label for="bonus" value="Bono" />
                    <x-jet-input type="number" step="0.01" placeholder="Bono" wire:model="bonus"
                        class="mt-1 block w-full rounded-fx" required />
                    @error('bonus')
                        <p class="text-red-500 font-semibold my-2">
                            {{ $message }}
                        </p>
                    @enderror
                    {{-- end bonus --}}
                    {{--Estado--}}
                    <x-jet-label class="mt-2" for="state" value="Estado" />
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

                    <x-jet-button goal="submit" class="h-12 w-full rounded-fx flex items-center justify-center">
                        Guardar
                    </x-jet-button>

                </form>

            @endslot
        </x-card-component>
    </div>

</div>