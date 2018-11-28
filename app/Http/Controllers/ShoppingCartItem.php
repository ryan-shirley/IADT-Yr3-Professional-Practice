<?php

namespace App\Http\Controllers;

class ShoppingCartItem {
    private $product;
    private $quantity;

    public function  __construct($product, $qty) {
        $this->product = $product;
        $this->quantity = $qty;
    }

    public function getProduct() { return $this->product; }
    public function getQuantity() { return $this->quantity; }
    public function setQuantity($qty) { $this->quantity = $qty; }
    public function getTotalPrice() { return $this->product->price * $this->quantity; }
    public function getPrice() { return $this->product->price; }
}
