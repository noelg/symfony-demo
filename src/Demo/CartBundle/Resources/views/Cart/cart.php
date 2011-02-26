<?php foreach ($cart as $product_id => $quantity): ?>
<div>
  <?php for ($i = 1; $i <= $quantity; $i++): ?>
    <a title="Remove this item" href="<?php echo $view->router->generate('cart_remove', array('id' => $product_id)) ?>">
      <img alt="" src="<?php echo $view->assets->getUrl('bundles/cart/images/'.$product_id.'.png') ?>" class="cart-items" id="item_<?php echo $product_id ?>_<?php echo $i ?>" style="position:relative" />
    </a>
  <?php endfor; ?>
  <span>(<?php echo $quantity ?> <?php echo $products[$product_id] ?>)</span>
</div>
<?php endforeach; ?>

<?php if (!count($cart)): ?>
  nothing yet in your shopping cart.
<?php endif; ?>