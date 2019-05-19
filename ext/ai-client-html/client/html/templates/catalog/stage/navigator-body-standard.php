<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2014
 * @copyright Aimeos (aimeos.org), 2015-2018
 */

$enc = $this->encoder();

?>
<?php $this->block()->start( 'catalog/stage/navigator' ); ?>
<!-- catalog.stage.navigator -->

	<?php if( $this->param( 'd_pos' ) !== null ) : ?>
		<div class="catalog-stage-navigator">
			<nav>

				<?php if( isset( $this->navigationPrev ) ) : ?>
				<button class="btn btn--purple"><a href="<?= $enc->attr( $this->navigationPrev ); ?>" rel="prev">
						<?= $enc->html( $this->translate( 'client', 'Previous' ), $enc::TRUST ); ?>
					</a></button>
					
				<?php endif; ?>

				<?php if( isset( $this->navigationNext ) ) : ?>
				<button class="btn btn--purple"><a href="<?= $enc->attr( $this->navigationNext ); ?>" rel="next">
						<?= $enc->html( $this->translate( 'client', 'Next' ), $enc::TRUST ); ?>
					</a></button>
					
				<?php endif; ?>

			</nav>
		</div>
	<?php endif; ?>

<!-- catalog.stage.navigator -->
<?php $this->block()->stop(); ?>
<?= $this->block()->get( 'catalog/stage/navigator' ); ?>
