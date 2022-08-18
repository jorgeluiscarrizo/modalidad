<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Asignar una Ruta
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-card-component>

            @slot('content')

                <form wire:submit.prevent="submit" class="lg:m-10 p-4">
        {{-- seleccionar vendedor --}}
        <div>
            <div class="">
                Seleccinar Vendedor
            </div>
            <select wire:model="seller_id" wire:change="onChangeSelectSeller"
                class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-fx rounded-full"
                required>

                <option selected></option>
                @forelse ($detailsell as $seller)
                    <option value="{{ $seller->id }}">
                        {{ $seller->name }}</option>
                @empty
                    <option disabled>Sin registros</option>
                @endforelse
            </select>

            @error('seller_id')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
        </div>
        {{-- end seleccionar vendedor --}}

        {{-- seleccionar rutas --}}
        <div>
            <div class="">
                Seleccinar Ruta
            </div>
            <select wire:model="route_id" wire:change="onChangeSelectRoute"
                class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-fx rounded-full"
                required>

                <option selected></option>
                @forelse ($detailroute as $route)
                    <option value="{{ $route->id }}">
                        {{ $route->neighborhood }}</option>
                @empty
                    <option disabled>Sin registros</option>
                @endforelse
            </select>

            @error('route_id')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
        </div>
        {{-- end seleccionar rutas --}}

         {{-- date_i --}}
         <x-jet-label for="date_i" value="Fecha inicio" />
         <x-jet-input type="date" placeholder="Fecha inicio" wire:model="date_i"
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


                    {{-- Estado --}}

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

                    <x-jet-button route="submit" class="h-12 w-full rounded-fx flex items-center justify-center">
                        Guardar
                    </x-jet-button>

                </form>

            @endslot
        </x-card-component>
    </div>
</div>