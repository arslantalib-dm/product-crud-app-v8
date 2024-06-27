<?php

namespace App\Service;

use App\Exports\ExportProduct;
use App\Interface\ProductRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;

class ProductService
{

    protected $productRepository;
    public function __construct(
        ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function findAll($data)
    {
        return $this->productRepository->findAll($data);
    }

    public function findBySlug(string $Slug)
    {
        return $this->productRepository->findBySlug($Slug);
    }

    public function store($data)
    {
        return $this->productRepository->create($data);
    }

    public function update($data)
    {
        $id = $data['id'];
        unset($data['id']);
        return $this->productRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }

    public function export()
    {
        $fileName = 'products.xlsx';
        Excel::store(new ExportProduct, $fileName);
        return asset('storage/' . $fileName);
    }
}
