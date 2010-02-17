<?php

namespace Bundle\CartBundle;

/**
 *  This file is a part of the symfony demo application
 *
 * (c) Noël GUILBERT <noelguilbert@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */


use Symfony\Framework\WebBundle\User as BaseUser;

class User extends BaseUser
{
  public function addItem($id)
  {
    $cart = $this->getCart();

    if (!isset($cart[$id]))
    {
      $cart[$id] = 1;
    }
    else
    {
      ++$cart[$id];
    }

    $this->setAttribute('cart', $cart);
  }

  public function removeItem($id)
  {
    $cart = $this->getCart();

    if (isset($cart[$id]) && --$cart[$id] == 0)
    {
      unset($cart[$id]);
    }

    $this->setAttribute('cart', $cart);
  }

  public function getCart()
  {
    return $this->getAttribute('cart', array());
  }
}