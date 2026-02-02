<?php

namespace interfaces;

interface CRUD
{
    public function api($num, $for);
    public function index($num, $for);
    public function get($id);
    public function getAll($page);
    public function create();
    public function update($id);
    public function delete($id);
}