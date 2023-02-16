<?php

namespace crazy\action;

use crazy\models\Order;

class AdminAction {

	public function execute(): string {
		$catalogue = '<div class="container"><div id="admin">';

		$catalogue .= '</div></div>';
		return $catalogue;
	}

}