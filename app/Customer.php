<?php

namespace App;

class Customer
{
  public function purchase(Store $store, Product $product, int $amount): bool
  {
    // $inventory = $store->getInventory($product);
    if ($store->hasEnoughInventory($product, $amount)) {
      $store->removeInventory($product, $amount);
      return true;
    } else {
      return false;
    }
  }
}
