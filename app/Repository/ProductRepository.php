<?php

namespace App\Repository;
use App\Interface\ProductRepositoryInterface;
use App\Models\Product;

Class ProductRepository implements ProductRepositoryInterface {


    public function findBySlug($slug) {
        return Product::where("slug", $slug)->first();
    }

    public function findById($id) {
        return Product::where("id", $id)->first();
    }

    public function findAll($data) {
        return Product::paginate(...$data);
    }

    public function create($data) {
        return Product::create($data);
    }

    public function update($id, $data) {
        Product::where('id', $id)->update($data);

        return $this->findById($id);
    }

    public function delete($id) {
        $product = $this->findById($id);
        if (!$product) {
            return false;
        }
        return $product->delete();
    }
}
