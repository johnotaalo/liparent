<?php

namespace LIPARENT\Superadmin\Controllers;

use LIPARENT\Common\Controllers\BaseController as Controller;
use LIPARENT\Common\Models\TenantPaymentV as TenantPayment;
use LIPARENT\Common\Models\Payment;

class PaymentsController extends Controller{
	function indexAction(){
		$variables = [
			"transactions_table"	=>	$this->createTransactionTable()
		];
		$this->view->content = $this->_view->setVars($variables)
										->getPartial('payments/index');
		$this->assets
		->addCss('vendors/datatables/dataTables.bootstrap.css');

		// And some local JavaScript resources
		$this->assets
		->addJs('vendors/datatables/jquery.dataTables.min.js')
		->addJs('vendors/datatables/dataTables.bootstrap.min.js');
		$custom_js = $this->_view->getPartial('partials/payments_js');
		$this->addJavascript($custom_js);
	}

	private function createTransactionTable(){
		$transactions = TenantPayment::find();
		$table = "";
		if ($transactions) {
			$counter = 1;
			foreach ($transactions as $transaction) {
				$pay_for = date('dS F Y', strtotime($transaction->period_from)) . " to " . date('dS F Y', strtotime($transaction->period_to));
				$verification = $transaction->verified;
				$action = "<a href = '#' class = 'label label-danger'>Not Verified</a>";
				if($verification == 1){
					$action = "<a href = '#' class = 'label label-success'>Verified</a>";
				}
				$table .= "<tr>";
				$table .= "<td>$counter</td>";
				$table .= "<td>$transaction->tenant_name</td>";
				$table .= "<td>$pay_for</td>";
				$table .= "<td>$transaction->transaction_code</td>";
				$table .= "<td>" . date('d-m-Y', strtotime($transaction->date)) ."</td>";
				$table .= "<td>$action</td>";
				$table .= "</tr>";

				$counter++;
			}
		}

		return $table;
	}
}