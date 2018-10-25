<?php
namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

require_once 'ShoppingCartItem.php';

class ShoppingCart extends Controller {
    private $items;

    public function __construct() {
        $this->items = array();
    }

    public function getItems() { return $this->items; }

    public function addToCart($product_id, $qty) {
        if (isset($this->items[$product_id])) {
            $item = $this->items[$product_id];
            $oldQuantity = $item->getQuantity();
            $item->setQuantity($oldQuantity + $qty);
        }
        else {
            $item = new ShoppingCartItem($product_id, $qty);
            $this->items[$product_id] = $item;
        }
    }

    public function updateCart($product_id, $qty) {
        if (isset($this->items[$product_id])) {
            if ($qty > 0) {
                $item = $this->items[$product_id];
                $item->setQuantity($qty);
            }
            else if ($qty == 0) {
                $this->item[$product_id] = NULL;
                unset($this->items[$product_id]);
            }
        }
        else {
            throw new Exception("Illegal request.");
        }
    }

    public function isEmpty() {
        return empty($this->items);
    }

    public function removeAll() {
        $this->items = array();
    }
}
?>
