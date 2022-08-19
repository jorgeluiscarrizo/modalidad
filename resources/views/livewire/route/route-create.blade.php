<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar Nueva Ruta
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-card-component>

            @slot('content')

                <form wire:submit.prevent="submit" class="lg:m-10 p-4">

                    {{-- neighborhood --}}
                    <x-jet-label for="neighborhood" />
                    <i class="fas fa-pencil-alt"> Barrio</i>
                    <x-jet-input type="text" placeholder="Barrio" wire:model="neighborhood" wire:keyup="generateSlug"
                        class="mt-1 block w-full rounded-fx" required />
                    @error('neighborhood')
                        <p class="text-red-500 font-semibold my-2">
                            {{ $message }}
                        </p>
                    @enderror
                    {{-- end neighborhood --}}

                    {{-- seleccionar ciudad --}}
                    <div>
                        <div class="">
                            <i class="fas fa-hand-pointer"> Seleccionar Ciudad </i>
                        </div>
                        <select wire:model="citi_id" wire:change="onChangeSelectCity"
                            class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-fx rounded-full"
                            required>

                            <option selected></option>
                            @forelse ($routecities as $city)
                                <option value="{{ $city->id }}">
                                    {{ $city->name }}</option>
                            @empty
                                <option disabled>Sin registros</option>
                            @endforelse
                        </select>

                        @error('citi_id')
                            <p class="text-red-500 font-semibold my-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    {{-- end seleccionar ciudad --}}

                    {{-- seleccionar meta --}}
                    <div>
                        <div class="">
                            <i class="fas fa-hand-pointer"> Seleccionar Meta </i>

                        </div>
                        <select wire:model="goal_id" wire:change="onChangeSelectGoal"
                            class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-fx rounded-full"
                            required>

                            <option selected></option>
                            @forelse ($routegoals as $goal)
                                <option value="{{ $goal->id }}">
                                    {{ $goal->amount }}</option>
                            @empty
                                <option disabled>Sin registros</option>
                            @endforelse
                        </select>

                        @error('goal_id')
                            <p class="text-red-500 font-semibold my-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    {{-- end seleccionar meta --}}

                    {{-- Estado --}}

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

                    <x-jet-button route="submit" class="h-12 w-full rounded-fx flex items-center justify-center">
                        Guardar
                    </x-jet-button>

                </form>

            @endslot
        </x-card-component>
    </div>

</div>
