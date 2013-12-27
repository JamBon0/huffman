<?php

abstract class AbstractNode {

	static function cmpNode(AbstractNode $a, AbstractNode $b) {
		return $a->getCount() - $b->getCount();
	}

	abstract function getCount();
}
