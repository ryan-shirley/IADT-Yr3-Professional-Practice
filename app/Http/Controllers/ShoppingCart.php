<?php

namespace App\Http\Controllers;

class ShoppingCart {
    private $items;

    public function __construct() {
        $this->items = array();
    }

    public function getItems() { return $this->items; }

    public function getTotalPrice() {
        $total = 0.0;
        foreach ($this->items as $item) {
            $total += $item->getTotalPrice();
        }
        return $total;
    }

    public function add($product, $qty) {
        if (isset($this->items[$product->id])) {
            $item = $this->items[$product->id];
            $oldQuantity = $item->getQuantity();
            $item->setQuantity($oldQuantity + $qty);
        }
        else {
            $item = new ShoppingCartItem($product, $qty);
            $this->items[$product->id] = $item;
        }
    }

    public function update($book, $qty) {

    }

    public function remove($product) {
        unset($this->items[$product->id]);
    }

    public function isEmpty() {
        return empty($this->items);
    }

    public function removeAll() {
        $this->items = array();
    }
}
