<?php

namespace App;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id)
    {
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];

        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        if ($item->sale_id == 1 && $item->descount > 0) {
            $storedItem['price'] = ($item->price - ($item->price * $item->descount)/100)* $storedItem['qty'];
        } else {
            $storedItem['price'] = $item->price * $storedItem['qty'];
        }
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += ($item->price - ($item->price * $item->descount)/100);
    }

    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
