<?php

namespace interfaces;

interface iModel{
    public function getAll(int $page);
    public function getByID(int $id);
    public function getCount();
    public function create(array $values);
    public function update(int $id, array $values);
    public function delete(int $id);
}