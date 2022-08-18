<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar venta
        </div>
    </x-slot>
    <div class="container m-auto bg-white mt-5 rounded-md">

        <form wire:submit.prevent="submit" class="m-10 mt-0 p-4">
            {{-- select client --}}

            <div wire:ignore class="my-2">
                <div class="">
                    Cliente
                </div>
                <select id="select-client" wire:model="client_id"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-full"
                    required>
                    <option selected>(Seleccionar)</option>
                    @forelse ($clients as $item)
                        <option value="{{ $item->id }}">
                            Celular: {{ $item->num_cell }} | Nombre:
                           {{$item->name }}</option>
                    @empty
                        <option disabled>Sin registros</option>
                    @endforelse
                </select>
                @error('client_id')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            {{-- end client --}}

            {{-- info client --}}
            <div class="mt-2 text-sm border rounded-md p-4">
                @if ($client)
                    <span class="opacity-50">Nombre completo : </span>
                    <span><strong>{{$client->name }}</strong></span>
                    <br>
                    <span class="opacity-50">Celular : </span>
                    <span><strong>{{ $client->num_cell }}</strong></span>
                    <br>
                @else
                    <span class="text-red-500 opacity-50">Ningun cliente seleccionado</span>
                @endif
            </div>
            {{-- end info client --}}
            {{-- select seller --}}
            <div wire:ignore class="my-2">
                <div class="">
                    Vendedor
                </div>
                <select id="select-sellers" wire:model="seller_id"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-full"
                    required>
                    <option selected>(Seleccionar)</option>
                    @forelse ($sellers as $item)
                        <option value="{{ $item->id }}"> Nombre:
                            {{$item->name }}</option>
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
            {{-- end seller --}}

            {{-- info seller --}}
            <div class="mt-2 text-sm border rounded-md p-4">
                @if ($seller)
                    <span class="opacity-50">Nombre completo : </span>
                    <span><strong> {{ $seller->name }}</strong></span>
                    <br>
                @else
                    <span class="text-red-500 opacity-50">Ningun vendedor seleccionado</span>
                @endif
            </div>
            {{-- end info seller --}}

            {{-- select batch --}}
            <div wire:ignore class="my-2">
                <div class="">
                    Lote
                </div>
                <select id="select-batchs" wire:model="batche_id"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-full"
                    required>
                    <option selected>(Seleccionar)</option>
                    @forelse ($batchs as $item)
                        <option value="{{ $item->id }}">
                            Lote {{$item->name }}, Producto {{$item->product->name}}
                        </option>
                    @empty
                        <option disabled>Sin registros</option>
                    @endforelse
                </select>
                @error('batche_id')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            {{-- end batch --}}
            {{-- info batch --}}
            <div class="mt-2 text-sm border rounded-md p-4">
                 @if ($batch)
                    <div class="flex justify-between ...">
                        <div>
                            <span class="opacity-50">Nombre : </span>
                            <span><strong>{{ $batch->name }}</strong></span>
                            <br>
                            <span class="opacity-50">Stock : </span>
                            <span><strong>{{ $batch->stock }}</strong></span>
                            <br>
                            <span class="opacity-50">Precio : </span>
                            <span><strong>{{ $batch->price }}</strong></span>
                            <br>
                            <hr class=" my-2">
                            <span class="opacity-50">Producto : </span>
                            <span><strong>{{ $batch->product->name }}</strong></span>
                        </div>
                        <div>
                            <a class="h-12 w-full rounded-full flex items-center justify-center px-4 py-2 cursor-pointer border border-transparent border-primary-500 text-primary-500 font-semibold text-xs  uppercase tracking-widest hover:bg-primary-500 hover:text-white transition ease-in-out duration-150"
                                wire:click="addItemCart()">
                                <i class="fas fa-cart-plus"></i>&nbsp;&nbsp; agregar
                            </a>
                        </div>
                    </div>
                @else
                    <span class="text-red-500 opacity-50">Ningun lote seleccionado</span>
                @endif 
            </div>
            {{-- end info batch --}}
            {{-- detial sale --}}
            <div class="container m-auto">
                <div class="grid md:grid-cols-3 grid-cols-1  gap-2 md:gap-4 pt-4 ">
                    <div
                        class="md:col-span-2 col-span-1   shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cantidad
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Precio
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Quitar
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                                @if (session('cart'))
                                    @foreach ($cart_session_ as $id => $item)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{-- {{ $item['name'] }} --}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <x-jet-input class="rounded-fx" type="number" name="quantity_product"
                                                    wire:model="cart_session_.{{ $id }}.quantity"
                                                    min="1" max="25"
                                                    wire:keyup="updateQuantity({{ $id }})"
                                                    wire:change="updateQuantity({{ $id }})" />
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                 {{ $item['price'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                 {{ $item['subtotal'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-2xl ">

                                                <a
                                                    class="inline-flex items-cente text-primary-500  hover:text-primary-700 cursor-pointer"><i
                                                        class="fas fa-cart-arrow-down"
                                                        wire:click='deletProductCart({{ $id }})'></i></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div
                        class="md:col-span-1 col-span-1 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                        <table class="w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" colspan="2"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total Carrito
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-left">
                                        Productos:
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                                        {{ $cart->count_items }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-left">
                                        Cantidad items:
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                                        {{ $cart->quantity_items }}
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot class="bg-primary-700 text-white">
                                <tr>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-left">
                                        Total:
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                                         {{ $cart->total }}
                                    </td>
                                </tr>
                            </tfoot>

                        </table>
                    </div>

                </div>
            </div>
            {{-- end detial sale --}}

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
            <x-jet-button type="submit" class="h-12 mt-4 w-full rounded-full flex items-center justify-center">
                Guardar
            </x-jet-button>
        </form>
    </div>
</div>
@push('custom-scripts')
    <script>
        document.addEventListener('livewire:load', function() {

            $('#select-client').select2();
            $('#select-client').on('change', function() {
                @this.set('client_id', this.value);
                @this.showInfoClient()
            });

            $('#select-batchs').select2();
            $('#select-batchs').on('change', function() {
                @this.set('batche_id', this.value);
                @this.showInfoBatch()
            });

            $('#select-sellers').select2();
            $('#select-sellers').on('change', function() {
                @this.set('seller_id', this.value);
                @this.showInfoSeller()
            });

        });
    </script>
@endpush


