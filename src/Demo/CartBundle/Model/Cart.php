<?php

namespace Demo\CartBundle\Model;

/**
 *  This file is a part of the symfony demo application
 *
 * (c) Noël GUILBERT <noelguilbert@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

class Cart
{
  protected $session;

  /**
   * Constructs the Cart instance
   *
   * @param Session $session 
   */
  public function __construct($session)
  {
    $this->session = $session;
  }

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

    $this->session->set('cart', $cart);
  }

  public function removeItem($id)
  {
    $cart = $this->getCart();

    if (isset($cart[$id]) && --$cart[$id] == 0)
    {
      unset($cart[$id]);
    }

    $this->session->set('cart', $cart);
  }

  public function getCart()
  {
    return $this->session->get('cart', array());
  }
}