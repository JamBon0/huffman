<?php

abstract class AbstractNode {

	public static function cmpNode(AbstractNode $a, AbstractNode $b) {
		return $a->getCount() - $b->getCount();
	}

	public abstract function getCount();
}
