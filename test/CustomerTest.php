<?php

use PHPUnit\Framework\TestCase;

require_once 'app/Store.php';
require_once 'app/Customer.php';
require_once 'app/Product.php';

use App\Store;
use App\Product;
use App\Customer;

final class CustomerTest extends TestCase
{
  /**
   * @test
   * リスト2.1 在庫が十分にある場合、購入は成功する
   */
  public function 在庫が十分にある場合、購入は成功する() : void
  {
    // Arrange
    $store = new Store();
    $store->addInventory(Product::Shampoo, 10);
    $sut = new Customer();

    // Act
    $success = $sut->purchase($store, Product::Shampoo, 5);

    // Assert
    $this->assertTrue($success);
  }

  /**
   * @test
   * リスト2.1 在庫が十分にない場合、購入は失敗する
   */
  public function 在庫が十分にない場合、購入は失敗する() : void
  {
    // Arrange
    $store = new Store();
    $store->addInventory(Product::Shampoo, 10);
    $sut = new Customer();

    // Act
    $success = $sut->purchase($store, Product::Shampoo, 15);

    // Assert
    $this->assertFalse($success);
  }
}
