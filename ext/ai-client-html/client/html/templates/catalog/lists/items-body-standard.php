<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2018
 */

$enc = $this->encoder();

/** client/html/catalog/lists/basket-add
 * Display the "add to basket" button for each product item
 *
 * Enables the button for adding products to the basket from the list view.
 * This works for all type of products, even for selection products with product
 * variants and product bundles. By default, also optional attributes are
 * displayed if they have been associated to a product.
 *
 * '''Note:''' To fetch the necessary product variants, you have to extend the
 * list of domains for "client/html/catalog/lists/domains", e.g.
 *
 *  client/html/catalog/lists/domains = array( 'attribute', 'media', 'price', 'product', 'text' )
 *
 * @param boolean True to display the button, false to hide it
 * @since 2016.01
 * @category Developer
 * @category User
 * @see client/html/catalog/domains
 */


?>
<?php $this->block()->start( 'catalog/lists/items' ); ?>
<div class="catalog-list-items">
<div class="left_menu">
	<div class='sub'>
		<h3>Sous-catégorie</h3>
		<div>
		<label for="huey">Yaourts</label>
			<input type="radio" id="huey" name="drone" value="huey" class="radio_border-purple"	checked>
			<span class="radio--white" for="radio_after-purple" for="radio_border-purple"></span>
		</div>

		<div>
		<label for="dewey">Crèmes</label>
			<input type="radio" id="dewey" name="drone" value="dewey" class="radio_border-purple">
			<span class="radio--white" for="radio_after-purple" for="radio_border-purple"></span>
		</div>
		<div>
		<label for="louie">Laitages</label>
			<input type="radio" id="louie" name="drone" value="louie" class="radio_border-purple">
			<span class="radio--white" for="radio_after-purple" for="radio_border-purple"></span>
		</div>
		</div>
	<div class='sub'>
		<h3>Saison</h3>
		<div>
		<label for="huey">Printemps</label>
			<input type="radio" id="huey" name="season" value="Printemps" class="radio_border-purple" checked>
			<span class="radio--white" for="radio_after-purple" for="radio_border-purple"></span>
		</div>

		<div>
		<label for="dewey">Eté</label>
			<input type="radio" id="dewey" name="season" value="Eté" class="radio_border-purple">
			<span class="radio--white" for="radio_after-purple" for="radio_border-purple"></span>
		</div>
		<div>
		<label for="louie">Automne</label>
			<input type="radio" id="louie" name="season" value="Automne" class="radio_border-purple">
			<span class="radio--white" for="radio_after-purple" for="radio_border-purple"></span>
		</div>
		<div>
		<label for="louie">Hiver</label>
			<input type="radio" id="louie" name="season" value="Hiver" class="radio_border-purple">
			<span class="radio--white" for="radio_after-purple" for="radio_border-purple"></span>
		</div>
	</div>

	<div class='sub'>
		<h3>Prix</h3>
		<div>
		<label for="huey">0-10€</label>
			<input type="radio" id="huey" name="money" value="0" class="radio_border-purple" checked>
			<span class="radio--white" for="radio_after-purple" for="radio_border-purple"></span>
		</div>

		<div>
		<label for="dewey">10-50€</label>
			<input type="radio" id="dewey" name="money" value="dewey" class="radio_border-purple">
			<span class="radio--white" for="radio_after-purple" for="radio_border-purple"></span>
		</div>
		<div>
		<label for="louie">50-100€</label>
			<input type="radio" id="louie" name="money" value="louie" class="radio_border-purple">
			<span class="radio--white" for="radio_after-purple" for="radio_border-purple"></span>
		</div>
	</div>
	<button class="button_background-yellow">Valider</button>
</div>
	<?= $this->partial(
		$this->config( 'client/html/common/partials/products', 'common/partials/products-standard' ),
		array(
			'require-stock' => (int) $this->config( 'client/html/basket/require-stock', true ),
			'basket-add' => $this->config( 'client/html/catalog/lists/basket-add', false ),
			'productItems' => $this->get( 'itemsProductItems', [] ),
			'products' => $this->get( 'listProductItems', [] ),
			'position' => $this->get( 'itemPosition' ),
		)
	); ?>

</div>
<?php $this->block()->stop(); ?>
<?= $this->block()->get( 'catalog/lists/items' ); ?>
