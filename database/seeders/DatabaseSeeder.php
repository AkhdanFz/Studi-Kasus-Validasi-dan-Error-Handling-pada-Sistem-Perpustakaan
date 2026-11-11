<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Products\Models\Product;
use App\Modules\Products\Models\Category;
use App\Modules\Auth\Models\Role;
use App\Models\User;
use App\Modules\Orders\Models\Order;
use App\Modules\Orders\Models\OrderItem;
use App\Modules\Orders\Models\OrderStatusHistory;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed roles
        $adminRole = Role::create(['name' => 'Administrator', 'slug' => 'admin']);
        $userRole  = Role::create(['name' => 'User', 'slug' => 'user']);

        // 2. Seed admin user
        $admin = User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@example.com',
            'password' => Hash::make('password123'),
        ]);
        $admin->roles()->attach($adminRole);

        // 3. Seed categories
        $categories = Category::factory()->count(10)->create();

        // 4. Seed products
        $products = Product::factory()->count(50)->create();

        // Attach categories to products
        $products->each(function ($product) use ($categories) {
            $product->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray(),
                ['added_at' => now()]
            );
        });

        // 5. Seed Orders (Seluruh kolom mandatory terpenuhi)
        for ($i = 1; $i <= 4; $i++) {
            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'user_id'      => $admin->id,
                'total_amount' => 150000,
                'status'       => 'pending',
            ]);

            if ($products->isNotEmpty()) {
                $selectedProduct = $products->random();
                $price           = $selectedProduct->price ?? 50000;
                $quantity        = rand(1, 3);

                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $selectedProduct->id,
                    'product_name' => $selectedProduct->name ?? 'Sample Product',
                    'price'        => $price,
                    'quantity'     => $quantity,
                    'subtotal'     => $price * $quantity,
                ]);
            }

            OrderStatusHistory::create([
                'order_id'   => $order->id,
                'status'     => 'pending',
                'changed_by' => $admin->id, // <-- Isi kolom changed_by di sini
                'notes'      => "Order #{$i} created",
            ]);
        }
    }
}