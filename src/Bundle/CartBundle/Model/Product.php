<?php

namespace Bundle\CartBundle\Model;

class Product
{
  public static function findAll()
  {
    return array('iphone' => 'iphone', 'imac' => 'iMac', 'ipad' => 'iPad', 'mac-book' => 'Mac Book');
  }
}