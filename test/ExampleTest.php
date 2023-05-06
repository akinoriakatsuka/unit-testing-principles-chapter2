<?php

use PHPUnit\Framework\TestCase;

require_once 'app/Message.php';

use App\Message;
use App\MessageRenderer;

final class ExampleTest extends TestCase
{
  /**
   * @test
   * リスト4.2 リファクタリングへの耐性のないテスト
   */
  public function MessageRendererは正しい補助的描画クラスを使っている() : void
  {
    $message = new Message();
    $sut = new MessageRenderer();
    $sut->messageRenderer();
    $this->assertCount(3, $sut->sub_renderers);
    $this->assertInstanceOf('App\HeaderRenderer', $sut->sub_renderers[0]);
    $this->assertInstanceOf('App\BodyRenderer', $sut->sub_renderers[1]);
    $this->assertInstanceOf('App\FooterRenderer', $sut->sub_renderers[2]);
  }


  /**
   * @test
   * リスト4.4 振る舞いを検証するテスト
   */
  public function MessageRendererは正しく描画する()
  {
    $sut = new MessageRenderer();
    $sut->messageRenderer();

    $message = new Message(
      'Header',
      'Body',
      'Footer'
    );
    
    $this->assertEquals(
      '<b>Header</b><p>Body</p><i>Footer</i>',
      $sut->render($message)
    );
  }
}
