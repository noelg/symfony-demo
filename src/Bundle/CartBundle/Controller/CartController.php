<?php

namespace Bundle\CartBundle\Controller;

/**
 *  This file is a part of the symfony demo application
 * 
 * (c) Noël GUILBERT <noelguilbert@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Symfony\Framework\FoundationBundle\Controller;
use Bundle\CartBundle\Model\Product;

class CartController extends Controller
{
  public function indexAction()
  {
    return $this->render('CartBundle:Cart:index', array(
      'products' => Product::findAll(),
      'cart' => $this->getUser()->getCart()
    ));
  }

  public function addAction($id)
  {
    $this->getUser()->addItem($id);

    if ($this->getRequest()->isXmlHttpRequest())
    {
      return $this->render('CartBundle:Cart:cart', array(
        'products' => Product::findAll(),
        'cart' => $this->getUser()->getCart()
      ));
    }
    else
    {
      return $this->redirect($this->generateUrl('cart'));
    }
  }

  public function removeAction($id)
  {
    $this->getUser()->removeItem($id);

    if ($this->getRequest()->isXmlHttpRequest())
    {
      return $this->render('CartBundle:Cart:cart', array(
        'products' => Product::findAll(),
        'cart' => $this->getUser()->getCart()
      ));
    }
    else
    {
      return $this->redirect($this->generateUrl('cart'));
    }
  }
}
