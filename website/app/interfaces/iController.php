<?php

namespace interfaces;

interface iController
{
    public function api(int $num, string $for);
    public function index(int $num, string $for);
    public function get(int $id);
    public function getAll(int $page = 1);
    public function create();
    public function update(int $id);
    public function delete(int $id);
}