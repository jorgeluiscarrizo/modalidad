<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar Lote
        </div>
    </x-slot>
    <div class="container m-auto bg-white mt-5 rounded-md">
        <div class="pt-10 px-10">
            <h1 class=" text-2xl font-bold">Agregar lote</h1>
        </div>
        <form wire:submit.prevent="submit" class="m-10 mt-0 p-4">

            {{-- select product --}}
            <div>
                <div class="">
                    <i class="fas fa-hand-pointer"> Seleccionar Producto </i>
                </div>
                <select wire:model="product_id" wire:change="onChangeSelectProduct"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-fx rounded-full"
                    required>

                    <option selected>(Seleccionar)</option>
                    @forelse ($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->name }}</option>
                    @empty
                        <option disabled></option>
                    @endforelse
                </select>

                @error('product_id')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            {{-- end product --}}

            {{-- name --}}
            <div class="">
                <i class="fas fa-pencil-alt"> Nombre</i>
            </div>
            <x-jet-input type="text" placeholder="Nombre" wire:model="name" class="mt-1 block w-full rounded-full"
                required />
            @error('name')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end name --}}

            {{-- price --}}
            <div class="">
                <i class="fas fa-money-bill"> Precio</i>
            </div>
            <x-jet-input type="number" step="0.01" placeholder="Precio" wire:model="price"
                class="mt-1 block w-full rounded-full" required />
            @error('price')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end price --}}

            {{-- stock --}}
            <div class="">
                <i class="fas fa-box"> Cantidad</i>

            </div>
            <x-jet-input type="number" placeholder="Cantidad" wire:model="stock" class="mt-1 block w-full rounded-full"
                required />
            @error('stock')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end stock --}}

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
            <x-jet-button type="submit" class="h-12 w-full rounded-full flex items-center justify-center">
                Guardar
            </x-jet-button>
        </form>
    </div>
</div>
