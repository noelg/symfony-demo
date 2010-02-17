<?php

namespace Bundle\CartBundle\Model;

/**
 *  This file is a part of the symfony demo application
 *
 * (c) Noël GUILBERT <noelguilbert@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

class Product
{
  public static function findAll()
  {
    return array('iphone' => 'iphone', 'imac' => 'iMac', 'ipad' => 'iPad', 'mac-book' => 'Mac Book');
  }
}