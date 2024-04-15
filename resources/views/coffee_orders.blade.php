<table class="table table-striped">
    <th>
        Coffee Brand
    </th>
    <th>
        Quantity
    </th>
    <th>
        Unit Price
    </th>
    <th>
        Selling Price
    </th>
    @if($coffeeOrders->isEmpty())
    <tr>
        <td colspan="4"> No Order Found</td>
    </tr>
    @endif
    @foreach($coffeeOrders as $order)
        <tr>
            <td> {{$order->coffeeBrand->brand_name}} </td>
            <td> {{$order->quantity}} </td>
            <td> &euro; {{$order->unit_price}} </td>
            <td> &euro; {{$order->selling_price}} </td>
        </tr>
    @endforeach
</table>