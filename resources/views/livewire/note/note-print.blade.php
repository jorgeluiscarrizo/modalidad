<div wire:ignore>

    <div id="printableArea">
        <table>
            <tr>
                <td>FECHA Y HORA</td>
                <td></td>
            </tr>
            <tr>
                <td><b>{{ $note->created_at }}</b></td>
                <td></td>
            </tr>
            <tr>
                <td>nombre</td>
            </tr>
            <tr>
                <td><b>{{ $client->name }}</b></td>
            </tr>
            <tr>
                <td>Vendedor designado:</td>
            </tr>
            <tr>
                <td><b>{{ $note->seller->name }}</b></td>
            </tr>
        </table>
        <hr class=" my-4">
        <h1><b>Detalle</b></h1>
        <table>
            <thead>
                <tr>
                    <th class="text-left border-2">Producto</th>
                    <th class="text-left border-2">Cantidad</th>
                    <th class="text-left border-2">Subtotal</th>
                </tr>
            </thead>

            @foreach ($productnotes as $item)
                <tr>
                    <td class="border-2">
                        {{ $item->batch->product->name }}
                    </td>
                    <td class="border-2 text-right">
                        {{ $item->amount }}
                    </td>
                    <td class="border-2 text-right">
                        {{ $item->subtotal }} $
                    </td>
                </tr>
            @endforeach
            <tr>
                <td class="border-2 text-right" colspan="3">
                    TOTAL <b>{{ $note->total }} $</b>
                </td>
            </tr>


        </table>

    </div>



    <div class="container m-auto bg-white rounded-md w-96 p-1 mt-5 mb-10">
        <x-jet-button id="btn_print" onclick="printDiv('printableArea')"
            class=" h-12 w-full rounded-full flex items-center justify-center">
            <i class="fas fa-print"></i>&nbsp; Imprimir
        </x-jet-button>

        <script>
            function printDiv(divName) {

                $("#btn_print").hide();
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;

                $("#btn_print").show();
            }
        </script>
    </div>
</div>
