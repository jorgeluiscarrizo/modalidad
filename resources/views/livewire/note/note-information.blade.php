<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle venta
        </div>
    </x-slot>
    <div class="container m-auto bg-white mt-5 rounded-md">
        <div class="w-full flex justify-start space-x-2 container bg-white">
            <div class="my-2 mx-4">
                <h1 class="text-lg opacity-50">Información de venta</h1>
                <h2 class="text-lg">Fecha: {{ $note->created_at }}</h2>
                <h2 class="text-xl font-bold">Total: {{ $note->total }}</h2>
            </div>
        </div>
    </div>
    <div class="container m-auto bg-white mt-5 rounded-md">
        <div class="w-full flex justify-start space-x-2 container bg-white">
            <div class="my-2 mx-4">
                <h1 class="text-lg opacity-50">Información del cliente</h1>
                <h1 class="text-2xl">Nombre : {{ $client->name }}</h1>
                <h2 class="text-lg">Celular : {{ $client->num_cell }}</h2>
            </div>
        </div>
    </div>
</div>
{{-- details --}}
<div class="container m-auto">
    <div class="grid md:grid-cols-1 grid-cols-1  gap-2 md:gap-4 pt-4 ">
        <div class="md:col-span-1 col-span-1 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <div class="bg-white p-2">
                <h1 class="text-lg opacity-50">Detalle de venta</h1>
            </div>
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
                            Sub Total
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if ($productnotes)
                        @foreach ($productnotes as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <p>Producto : {{ $item->batch->name }} </p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $item->amount }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $item->price }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $item->subtotal }}
                                </td>
                            </tr>
                        @endforeach
                    @endif


                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- end details --}}