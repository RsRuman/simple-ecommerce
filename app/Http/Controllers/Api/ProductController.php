<?php

namespace App\Http\Controllers\Api;

use AllowDynamicProperties;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Http\Request;

#[AllowDynamicProperties]
class ProductController extends Controller
{
    public function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Get all product with paginate
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $products = $this->productRepository->all($request);
        $products = ProductResource::collection($products);
        $products = $this->collectionResponse($products);

        return response()->json([
            'message' => 'Success',
            'data'    => $products,
        ], HttpResponse::HTTP_OK);
    }

    /**
     * Store a product
     * @param ProductStoreRequest $request
     * @return JsonResponse
     */
    public function store(ProductStoreRequest $request): JsonResponse
    {
        $data = $request->only('name', 'price', 'categories');

        $product = $this->productRepository->create($data);

        if (!$product) {
            return response()->json([
                'message' => 'Product could not be created.',
            ], HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json([
            'message' => 'Product created successfully.',
        ], HttpResponse::HTTP_CREATED);
    }
}
