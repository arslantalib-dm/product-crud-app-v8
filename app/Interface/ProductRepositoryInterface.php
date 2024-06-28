<?php

namespace App\Interface;

Interface ProductRepositoryInterface{
    public function create($data);
    public function update($id, $data);
    public function delete($id);
    public function findBySlug($slug);
    public function findAll($data);
    public function count();
}
