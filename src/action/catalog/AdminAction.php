<?php

namespace crazy\action\catalog;

use crazy\models\Order;

class AdminAction {

	public function execute(): string {
		$catalogue = '<h1>Admin</h1>
				<table class="table">
				<thead>
					<tr>
						<th scope="col">Order ID</th>
						<th scope="col">User ID</th>
						<th scope="col">Date de la commande</th>
						<th scope="col">Date RDV</th>
						<th scope="col">Lieu RDV</th>
					</tr>
				</thead>
				<tbody>';
		$orders = Order::all();
		foreach ($orders as $order) {
			$catalogue .= <<<HTML
				<tr>
					<td>{$order->id}</td>
					<td>{$order->user_id}</td>
					<td>{$order->date}</td>
					<td>{$order->date_rdv}</td>
					<td>{$order->lieu_rdv}</td>
				</tr>
				</tbody>
			</table>
HTML;
		}
		return $catalogue;
	}

}