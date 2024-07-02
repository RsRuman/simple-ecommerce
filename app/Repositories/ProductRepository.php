<?php

namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Product;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductRepository implements ProductInterface
{
    /**
     * All products with pagination
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function all(Request $request): LengthAwarePaginator
    {
        $perPage = $request->query('per_page', 10);

        return Product::query()
            ->when($request->query('sort'), function ($q) use ($request) {
                $sort = $request->query('sort');

                match ($sort) {
                    'best_sell'         => $q->withCount('orderDetails')->orderBy('order_details_count', 'desc'),
                    'top_rated'         => $q->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc'),
                    'price_high_to_low' => $q->orderBy('price', 'desc'),
                    'price_low_to_high' => $q->orderBy('price', 'asc'),
                    default             => null
                };
            })
            ->paginate($perPage);
    }

    public function find(int $id)
    {
        // TODO: Implement find() method.
    }

    /**
     * Store product data to database
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool
    {
        try {
            DB::beginTransaction();
            $product = Product::create([
                'name'  => $data['name'],
                'slug'  => Str::slug($data['name']),
                'price' => $data['price'],
            ]);

            if (!$product) {
                throw new Exception('Could not create product');
            }

            $product->categories()->attach($data['categories']);
            DB::commit();

            return true;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollBack();

            return false;
        }
    }

    public function update(int $id, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }
}
