<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Cliente
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-card-component>

            @slot('content')
                <form wire:submit.prevent="submit" class="lg:m-10 p-4">
                   
                  {{-- name --}}
                  <x-jet-label for="name" value="Nombre" />
                  <x-jet-input type="text" placeholder="Nombre" wire:model="name" wire:keyup="generateSlug"
                      class="mt-1 block w-full rounded-fx" required />
                  @error('name')
                      <p class="text-red-500 font-semibold my-2">
                          {{ $message }}
                      </p>
                  @enderror
                  {{-- end name --}}

      {{-- select unread_type --}}
      <div>
          <div class="">
              Seleccionar Tipo
          </div>
          <select wire:model="id_type" wire:change="onChangeSelectType"
              class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-fx rounded-full"
              required>

              <option selected></option>
              @forelse ($clienttypes as $type)
                  <option value="{{ $type->id }}">
                      {{ $type->name }}</option>
              @empty
                  <option disabled>Sin registros</option>
              @endforelse
          </select>

          @error('id_type')
              <p class="text-red-500 font-semibold my-2">
                  {{ $message }}
              </p>
          @enderror
      </div>
      {{-- end unread_type --}}

                  {{-- num_cell --}}
                  <x-jet-label for="num_cell" value="Numero Celular" />
                  <x-jet-input type="text" placeholder="Numero Celular" wire:model="num_cell"
                      class="mt-1 block w-full rounded-fx" required />
                  @error('num_cell')
                      <p class="text-red-500 font-semibold my-2">
                          {{ $message }}
                      </p>
                  @enderror
                  {{-- end num_cell --}}
                    
                    

                    {{-- state --}}
                    <x-jet-label class="mt-2" for="state" value="{{ __('Estado') }}" />
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
