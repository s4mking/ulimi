<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2018
 */

$enc = $this->encoder();

$optTarget = $this->config( 'client/jsonapi/url/target' );
$optCntl = $this->config( 'client/jsonapi/url/controller', 'jsonapi' );
$optAction = $this->config( 'client/jsonapi/url/action', 'options' );
$optConfig = $this->config( 'client/jsonapi/url/config', [] );


?>
<h1>Mon compte</h1>
<ul>
	<li><a href="/profile/edit">Modifier mon compte</a></li>
	<li><a href="/profile/change-password">Modifier mon mot de passe</a></li>
	<li><a href="/logout">Se déconnecter</a></li>
</ul>
<section class="aimeos account-subscription" data-jsonurl="<?= $enc->attr( $this->url( $optTarget, $optCntl, $optAction, [], [], $optConfig ) ); ?>">

	<?php if( ( $errors = $this->get( 'subscriptionErrorList', [] ) ) !== [] ) : ?>
		<ul class="error-list">
			<?php foreach( $errors as $error ) : ?>
				<li class="error-item"><?= $enc->html( $error ); ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	<?= $this->get( 'subscriptionBody' ); ?>

</section>
