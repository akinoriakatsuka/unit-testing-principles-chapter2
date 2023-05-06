<?php

namespace App;

class Message
{
  public $header;
  public $body;
  public $footer;

  public function __construct(
    string $header = '',
    string $body = '',
    string $footer = ''
  ) {
    $this->header = $header;
    $this->body = $body;
    $this->footer = $footer;
  }
}

abstract class IRenderer
{
  abstract public function render(Message $message) : string;
}

class MessageRenderer extends IRenderer
{
  public $sub_renderers;

  public function messageRenderer()
  {
    $this->sub_renderers = [
      new HeaderRenderer(),
      new BodyRenderer(),
      new FooterRenderer()
    ];  
  }

  public function render(Message $message) : string
  {
    $result = '';
    foreach ($this->sub_renderers as $renderer) {
      $result .= $renderer->render($message);
    }
    return $result;
  }
}

class HeaderRenderer extends IRenderer
{
  public function render(Message $message) : string
  {
    return "<b>$message->header</b>";
  }
}

class BodyRenderer extends IRenderer
{
  public function render(Message $message) : string
  {
    return "<p>$message->body</p>";
  }
}

class FooterRenderer extends IRenderer
{
  public function render(Message $message) : string
  {
    return "<i>$message->footer</i>";
  }
}