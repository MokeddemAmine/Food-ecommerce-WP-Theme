<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
global $woocommerce;

$variation_ids = array();
$target_attribute = 'sizes';
if($product->get_type() == 'variable'){
	?>
	<a type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#<?php echo  $product->slug ?>"><i class="fa-solid fa-plus-circle"></i></a>
	
	<!-- Modal -->
	<div class="modal fade" id="<?php echo $product->slug ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-xl">
		<div class="modal-content">
		  <div class="modal-header">
			<h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<?php 
				$default_attributes 	= $product->get_default_attributes();
				$available_attributes 	= $product->get_available_variations();

				foreach($available_attributes as $variation_values){
					foreach($variation_values['attributes'] as $key => $attribute_value){
						$attribute_name = str_replace('attribute_','',$key);

						if($attribute_name == $target_attribute){
							$default_value = $product->get_variation_default_attribute($attribute_name);
							//if($default_value == $attribute_value){
								$variation_ids[] = $variation_values['variation_id'];
							//}
						}
					}
				}

				if(count($variation_ids) > 0){
					foreach($variation_ids as $variation_id){
						$variation = wc_get_product($variation_id);

						$variation_attribute = $variation->get_variation_attributes();
						$variation_price = $variation->get_price();

						$full_name = $variation_attribute['attribute_sizes'].' '.$variation_attribute['attribute_accompaniments'].' '.get_woocommerce_currency_symbol().$variation_price;
						?>	
							<div>
								
								<input type="checkbox" name="<?php echo $full_name ?>" value="<?php echo $full_name ?>" id="<?php echo $full_name ?>" />
								<label for="<?php echo $full_name ?>">
									<?php echo $full_name ?>
								</label>

							</div>
						<?php
					}
				}
			?>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="button" class="btn btn-warning">Save changes</button>
		  </div>
		</div>
	  </div>
	</div>
	<?php
}else{
echo apply_filters(
	'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
	sprintf(
		'<a href="%s" aria-describedby="woocommerce_loop_add_to_cart_link_describedby_%s" data-quantity="%s" class="%s" %s>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( $product->get_id() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		esc_html( $product->add_to_cart_text() )
	),
	$product,
	$args
);
}
?>
<span id="woocommerce_loop_add_to_cart_link_describedby_<?php echo esc_attr( $product->get_id() ); ?>" class="screen-reader-text">
	<?php echo esc_html( $args['aria-describedby_text'] ); ?>
</span>
