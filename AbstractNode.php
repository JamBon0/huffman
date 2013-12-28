<?php

/**
 *
 */
abstract class AbstractNode {

	/**
	 *
	 * @param AbstractNode $a
	 * @param AbstractNode $b
	 * @return int
	 */
	public static function cmpNode(AbstractNode $a, AbstractNode $b) {
		return $a->getCount() - $b->getCount();
	}

	/**
	 *
	 * @return int
	 */
	public abstract function getCount();
}
