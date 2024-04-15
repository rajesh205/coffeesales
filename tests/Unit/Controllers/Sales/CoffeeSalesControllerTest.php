<?php

namespace Tests\Unit\Controllers\Sales;

use Tests\TestCase;
use App\Models\User;
use App\Models\CoffeeOrder;
use App\Models\CoffeeBrand;
use App\Models\Configuration;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CoffeeSalesControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_stores_coffee_sale()
    {
        // Create a user
        $user = User::factory()->create();

        // Get the CSRF token from the application
        $token = csrf_token();

        // Create necessary data for the sale
        $coffeeBrand = CoffeeBrand::factory()->create();
        $configuration = Configuration::factory()->create();
        $requestData = [
            'quantity' => 2,
            'brand' => $coffeeBrand->id,
            'unit_price' => 5.99,
            'selling_price' => 7.99
        ];

        // Make a POST request to store the sale, including the CSRF token in the headers
    $response = $this->withHeaders([
        'X-CSRF-TOKEN' => $token,
    ])->post(route('coffee.store'), $requestData);
    
        // Mock the authenticated user
        $this->actingAs($user);

        // Make a POST request to store the sale
        $response = $this->post(route('coffee.store'), $requestData);

        // Assert the response is successful
        $response->assertStatus(200);

        // Assert the sale is stored in the database
        $this->assertDatabaseHas('coffee_orders', [
            'quantity' => $requestData['quantity'],
            'brand' => $requestData['brand'],
            'unit_price' => $requestData['unit_price'],
            'selling_price' => $requestData['selling_price'],
            'user_id' => $user->id,
        ]);
    }
}
