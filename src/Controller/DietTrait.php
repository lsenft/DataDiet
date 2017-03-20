<?php

namespace Lsenft\DataDiet\Controller;

use Lsenft\DataDiet\Event\LoggedInUserListener;

/**
 * Class DietTrait
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 */
trait DietTrait {

/**
 * {@inheritDoc}
 */
	public function loadModel($modelClass = null, $type = 'Table') {
		$model = parent::loadModel($modelClass, $type);
		$listener = new LoggedInUserListener($this->Auth);
		$model->eventManager()->attach($listener);
		return $model;
	}

} 