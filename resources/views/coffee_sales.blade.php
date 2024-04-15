<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New ☕️ Sales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form  method="POST" >
                        @csrf
                        <div class="mb-3 col-3 coffee-sales">
                            <label for="exampleInputEmail1" class="form-label">Product</label>
                            <select class="form-control" name="brand" id="brands">
                                <option value="">-- Select Brand --</option>
                                @foreach ($coffeeBrands as $brand)
                                    <option value="{{ $brand->id }}" calc= "{{ $brand->profit_margin }}">{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>
                            <div class="error" id="brands_error"></div>
                        </div>
                        <div class="mb-3 col-3 coffee-sales">
                            <label for="exampleInputPassword1" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity">
                            <div class="error" id="quantity_error"></div>
                        </div>
                        <div class="mb-3 col-3 coffee-sales">
                            <label for="exampleInputPassword1" class="form-label">Unit Price</label>
                            <input type="text" class="form-control" id="unit_price" name="unit_price">
                            <div class="error" id="unit_price_error"></div>
                        </div>
                        <div class="mb-3 col-3 coffee-sales">
                            <label for="exampleInputPassword1" class="form-label">Selling Price</label>
                            <input type="text" class="form-control" id="selling_price" name="selling_price" value="0.00" readonly>
                            <div class="error" id="selling_price_error"></div>
                            <input type="hidden" class="form-control" id="shipping_cost" name="shipping_cost" value="{{ $configurations->shipping_cost }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Record Sale</button>
                    </form>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 coffee_orders">
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function() {

        /**
         * @return void
         */
        function calculateSellingPrice()
        {
            var quantity = $("#quantity").val(); 
            var unitPrice = $("#unit_price").val();
            var margin = $("#brands").find('option:selected').attr('calc');
            var shippingCost = $("#shipping_cost").val();

            if(unitPrice != '' && quantity != '') {
                var cost = quantity*unitPrice;

                var sellingPrice = (cost/ (1-margin))+shippingCost;
                console.log(sellingPrice);
                $("#selling_price").val(Math.round(sellingPrice * 100) / 100);
            }
        }

        // Calculating Selling Price based in Quantity, Unit Price and Coffe Brand
        $("#unit_price, #brands, #quantity").change(function() {
            calculateSellingPrice();
        });

        // Storing the Coffeed Order into the Database Records
        $("form").submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            var error_count = 0;
            $(".form-control").each(function() {
                if($(this).val() == '' || $(this).val() == '0.00') {
                    $("#"+$(this).attr("id")+"_error").text("Please do not leave empty");
                    error_count++;
                } else {
                    $("#"+$(this).attr("id")+"_error").text("");
                }
            });
            if (error_count > 0) {
                return false;    
            }

            $.ajax({
                url: '/recordsales',
                method : 'POST',
                data: formData,
                success: function(response) {
                    $(".coffee_orders").html(response);
                },
                error: function(xhr, status, error) {
                    console.log(status);
                }
            })
        });
    })
</script>