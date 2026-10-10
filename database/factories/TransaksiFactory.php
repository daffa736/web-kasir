<?php

namespace Database\Factories;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_transaksi' => fake()->words(5 , true),
            'total_harga' => fake()->numberBetween(10000,10000),
            'bayar' => fake()->numberBetween(10000,10000),
            'kembalian' => fake()->numberBetween(10000,10000),
            'created_at' => fake()->dateTime(),
        ];
    }
}
