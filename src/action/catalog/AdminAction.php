<?php

namespace crazy\action\catalog;

use crazy\models\Order;

class AdminAction {

	public function execute(): string {
		$catalogue = '<div class="container"><div id="admin">';

		$catalogue .= '</div></div>';
		return $catalogue;
	}

}