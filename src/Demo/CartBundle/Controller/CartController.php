<?php

namespace Demo\CartBundle\Controller;

/**
 *  This file is a part of the symfony demo application
 *
 * (c) Noël GUILBERT <noelguilbert@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Demo\CartBundle\Model\Product;
use Demo\CartBundle\Model\Cart;


class CartController extends Controller
{

  public function indexAction()
  {
    $cart = new Cart($this->container->get('request')->getSession());

    return $this->render('CartBundle:Cart:index.html.twig', array(
      'products' => Product::findAll(),
      'cart' => $cart->getCart()
    ));
  }

  public function addAction($id)
  {
    $cart = new Cart($this->container->get('request')->getSession());
    $cart->addItem($id);

    if ($this->container->get('request')->isXmlHttpRequest())
    {
      return $this->render('CartBundle:Cart:cart.html.twig', array(
        'products' => Product::findAll(),
        'cart' => $cart->getCart()
      ));
    }
    else
    {
      return $this->redirect($this->generateUrl('cart'));
    }
  }

  public function removeAction($id)
  {
    $cart = new Cart($this->container->get('request')->getSession());
    $cart->removeItem($id);

    if ($this->container->get('request')->isXmlHttpRequest())
    {
      return $this->render('CartBundle:Cart:cart.html.twig', array(
        'products' => Product::findAll(),
        'cart' => $cart->getCart()
      ));
    }
    else
    {
      return $this->redirect($this->generateUrl('cart'));
    }
  }
}
