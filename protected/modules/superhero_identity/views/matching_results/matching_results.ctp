<?php
	/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => __('Agent key strengths'), 'imgSrc' => ($this->webroot.'img/header-profile.jpg')));
	$this->end();
?>

<div class="evoke row">
	<div class="large-8 small-centered columns form-evoke-style">
		<h3 class = "text-center margin-top-1em margin-bottom-1em"><?= __('And your Superhero Identity is:') ?></h3>

		<div class = "row" data-equalizer>
			<div class="large-6 columns text-center" data-equalizer-watch>
				<i class="fa fa-lightbulb-o fa-5x"></i>
			</div>
			<div class="large-6 columns" data-equalizer-watch>
				<h3 class = "font-green font-weight-bold"><?= $superhero['SuperheroIdentity']['name'] ?></h3>
				<p><?= $superhero['SuperheroIdentity']['description'] ?></p>
				<p><?= __('You get:') ?></p>
				<ul>
					<li>2x <?= $primary_power['Power']['name'] ?></li>
					<li>1x <?= $secondary_power['Power']['name'] ?></li>
				</ul>
			</div>
		</div>

		<br><br>
		<div class = "row" data-equalizer>
			<div class="large-6 columns" data-equalizer-watch>
				<div class = "full-height gray-block block-green-border" id = "matchingInfo">
					<h4><?= $primary_power['Power']['name'] ?></h4>
					<p class="text-color-highlight"><?= $primary_power['Power']['description'] ?></p>
				</div>
			</div>
			<div class="large-6 columns" data-equalizer-watch>
				<div class = "full-height gray-block block-green-border" id = "matchingInfo">
					<h4><?= $secondary_power['Power']['name'] ?></h4>
					<p class="text-color-highlight"><?= $secondary_power['Power']['description'] ?></p>
				</div>
			</div>
		</div>

	</div>
</div>

<div class="text-center">
	<a class="button margin-top-3em" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', AuthComponent::user('id'))); ?>"><?php echo __("Great! What's next?"); ?></a>
</div>

<?php
	//SCRIPT
	$this->Html->script('requirejs/app/Users/matching_results.js', array('inline' => false));
?>
