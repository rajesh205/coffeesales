<?php
/**
 * File description here.
 *
 * PHP version 8.2
 *
 * @category CoffeeSales
 * @package  Category
 * @author   Rajesh <rajeshgoud6785@gmail.com>
 * @license  http://example.com LICENCENAME
 * @link     http://example.com
 */
namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\CoffeeBrand;
use Illuminate\Http\Request;
use App\Models\Configuration;
use App\Models\CoffeeOrder;
use Illuminate\Support\Facades\Auth;

/**
 * CoffeeSalesController class
 * 
 * @category COfffeSales
 * @package  Coffee
 * @author   Rajesh <rajeshgoud6785@gmail.com>
 * @license  http://example.com LICENCENAME
 * @link     http://example.com
 */
class CoffeeSalesController extends Controller
{
    /**
     * Displays a form to add Record
     * 
     * @return void
     */
    public function createCoffeeSale() 
    {
        $coffeeBrands = CoffeeBrand::all();
        $configurations = Configuration::first();
        $coffeeOrders = CoffeeOrder::where("user_id", Auth::user()->id)
                        ->with('coffeeBrand')->get();
        return view(
            'coffee_sales', [
                    'coffeeBrands' => $coffeeBrands,
                    'configurations' => $configurations, 
                    'coffeeOrders' => $coffeeOrders
            ]
        );
    }

    /**
     * StoreSales function
     *
     * @param Request $request The request object containing sales data.
     * 
     * @return void
     */
    public function storeSales(Request $request)
    {
        $request->validate(
            [
            'quantity' => 'required',
            'brand' => 'required',
            'unit_price' => 'required',
            'selling_price' => 'required',
            ]
        );
        $requestParams = $request->all();
        $requestParams['user_id'] = Auth::user()->id;
        CoffeeOrder::create($requestParams);
        $coffeeOrders = CoffeeOrder::where("user_id", Auth::user()->id)
                        ->with('coffeeBrand')->get();
        return view('coffee_orders', ['coffeeOrders' => $coffeeOrders]);
    }
}

