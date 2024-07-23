<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_homepage_contains_empty_table(): void
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
        
        $response->assertSee(__('No products found'));
    }
    
    public function test_homepage_contains_non_empty_table(): void
    {
        // dd(DB::connection()->getConfig());// Muestra la configuracion de conexión
        
        Product::create([
            'name' => 'Product 1',
            'price' => 123
        ]);
        
        $response = $this->get('/products');

        $response->assertStatus(200);
        
        $response->assertDontSee(__('No products found'));
        $response->assertSee('Product 1');
    }
}
