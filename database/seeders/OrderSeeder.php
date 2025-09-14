<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Sample orders for demo
        $order1 = Order::create([
            'user_id' => 2, // User Demo
            'status' => 'completed',
            'total_price' => 120000,
            'notes' => 'Mohon dikemas dengan rapi',
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'product_id' => 1, // Tas Rajutan
            'quantity' => 1,
            'price' => 75000,
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'product_id' => 2, // Dompet Kulit
            'quantity' => 1,
            'price' => 45000,
        ]);

        $order2 = Order::create([
            'user_id' => 3, // Budi Santoso
            'status' => 'pending',
            'total_price' => 70000,
            'notes' => 'Pengiriman sore hari',
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'product_id' => 4, // Brownies Coklat
            'quantity' => 2,
            'price' => 35000,
        ]);

        $order3 = Order::create([
            'user_id' => 4, // Siti Aminah
            'status' => 'confirmed',
            'total_price' => 190000,
            'notes' => '',
        ]);

        OrderItem::create([
            'order_id' => $order3->id,
            'product_id' => 9, // Lukisan Abstrak
            'quantity' => 1,
            'price' => 125000,
        ]);

        OrderItem::create([
            'order_id' => $order3->id,
            'product_id' => 13, // Kaos Custom
            'quantity' => 1,
            'price' => 65000,
        ]);
    }
}
