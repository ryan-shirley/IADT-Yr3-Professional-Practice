<?php
namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShoppingCartItem {
    private $product_id;
    private $quantity;

    public function  __construct($id, $qty) {
        $this->product_id = $id;
        $this->quantity = $qty;
    }

    public function getProductId() { return $this->product_id; }
    public function getQuantity() { return $this->quantity; }
    public function setQuantity($qty) { $this->quantity = $qty; }
}
?>
