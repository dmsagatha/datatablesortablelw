<?php

namespace App\Support;

trait WithConfirmation
{
  public function confirm($callback, ...$argv)
  {
    $this->emit('confirm', compact('callback', 'argv'));
  }
}