<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Enums\ResponseStatus;
use App\Exports\ExportProduct;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Service\ProductService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(
        ProductService $productService
    ) {
        $this->productService = $productService;
    }
    public function index(Request $request)
    {
        $page = $request->input("page", 1);
        $per_page = $request->input("per_page", 12);
        try {
            $products = $this->productService->findAll([
                $per_page,
                '*',
                'page',
                $page
            ]);

            return response()->success(new ProductResource($products), 'Fetch All Records', ResponseStatus::SUCCESS);
        } catch (\Exception $th) {
            return response()->error($th->getMessage(), ResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $product = $this->productService->store($request->validated());
            return response()->success($product, 'store successfully', ResponseStatus::CREATED);
        } catch (\Exception $th) {
            return response()->error($th->getMessage(), ResponseStatus::INTERNAL_SERVER_ERROR);
        }

    }

    public function find($slug)
    {
        try {
            $product = $this->productService->findBySlug($slug);
            if (!$product) {
                return response()->error("Product not found", ResponseStatus::NOT_FOUND);
            }
            return response()->success($product, 'find product successfully', ResponseStatus::SUCCESS);
        } catch (\Exception $th) {
            return response()->error($th->getMessage(), ResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateProductRequest $request)
    {
        try {
            $product = $this->productService->update($request->validated());
            return response()->success($product, 'update successfully', ResponseStatus::CREATED);
        } catch (\Exception $th) {
            return response()->error($th->getMessage(), ResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $product = $this->productService->delete($id);
            if (!$product) {
                return response()->error("Product Not Found", ResponseStatus::NOT_FOUND);
            }
            return response()->success(null, 'delete successfully', ResponseStatus::SUCCESS);
        } catch (\Exception $th) {
            return response()->error($th->getMessage(), ResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function export()
    {
        try {
            $downloadUrl = $this->productService->export();
            return response()->success(['download_url' => $downloadUrl], 'export successfully', ResponseStatus::SUCCESS);
        } catch (\Exception $th) {
            return response()->error($th->getMessage(), ResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }
}
