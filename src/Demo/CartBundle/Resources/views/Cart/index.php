<?php $view->extend('::layout') ?>
<?php $view->stylesheets->add('bundles/cart/css/cart.css') ?>
<?php $view->javascripts->add('http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js') ?>
<?php $view->javascripts->add('http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js') ?>
<?php $view->javascripts->add('bundles/cart/js/cart.js') ?>

<h1>Symfony Apple store demo</h1>

<div id="shopping_cart">
  <h2>Products:</h2>

  <div id="product_list">
    <?php foreach ($products as $id => $title): ?>
      <a title="Add this item" href="<?php echo $view->router->generate('cart_add', array('id' => $id)) ?>" style="display:inline-block">
        <img alt="" src="<?php echo $view->assets->getUrl('bundles/cart/images/'.$id.'.png') ?>" class="products" id="product_<?php echo $id ?>" />
      </a>
    <?php endforeach; ?>
  </div>

  <h2>Cart:</h2>
  
  <div id="wastebin" style="float:right">
    <img id="wastebin" src="<?php echo $view->assets->getUrl('bundles/cart/images/trash.png') ?>" alt="" />
  </div>


  <div id="cart" class="cart">
    <div id="items">
      <?php echo $view->render('CartBundle:Cart:cart', array('cart' => $cart, 'products' => $products)) ?>
    </div>
    <div style="clear: both"></div>
  </div>

  <p>Images are the courtesy of <a href="http://www.iconspedia.com">iconspedia</a>.</p>
</div>