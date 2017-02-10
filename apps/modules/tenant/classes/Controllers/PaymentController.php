<?php

namespace LIPARENT\Tenant\Controllers;

use LIPARENT\Common\Controllers\BaseController as Controller;
use LIPARENT\Common\Models\Payment;
use LIPARENT\Common\Models\Tenant;

class PaymentController extends Controller{

	public function indexAction(){
		$variables = [
			'payments_table'	=>	$this->createTransactionsTable()
		];

		$this->view->content = $this->_view
		->setVars($variables)
		->getPartial('payment/index');

		$this->assets
		->addCss('vendors/datatables/dataTables.bootstrap.css');

		// And some local JavaScript resources
		$this->assets
		->addJs('vendors/datatables/jquery.dataTables.min.js')
		->addJs('vendors/datatables/dataTables.bootstrap.min.js');

		$custom_js = $this->_view->getPartial('partials/transaction_js');

		$this->addJavaScript($custom_js);
	}

	private function createTransactionsTable(){
		$tenant = Tenant::findFirstByUserId($this->session->get('user_id'));
		$transactions = Payment::findByTenantId($tenant->id);

		$table = "";

		if(count($transactions)){
			$counter = 1;
			foreach ($transactions as $transaction) {
				$pay_for = date('dS F Y', strtotime($transaction->period_from)) . " to " . date('dS F Y', strtotime($transaction->period_to));
				$verification = ($transaction->verified == 1) ? '<a href = "#" class = "label label-success">Verified</a>' : '<a href = "#" class = "label label-danger">Not Verified</a>';
				$table .= "<tr>";
				$table .= "<td>{$counter}</td>";
				$table .= "<td>{$pay_for}</td>";
				$table .= "<td>{$transaction->transaction_code}</td>";
				$table .= "<td>KSH. " .number_format($transaction->amount, 2). "</td>";
				$table .= "<td>{$verification}</td>";
				$table .= "<td>".date('d-M-Y h:i a', strtotime($transaction->date))."</td>";
				$table .= "<td><center><a class='btn btn-primary waves-effect'><i class='zmdi zmdi-print'></i></a></td></center>";
				$table .= "</tr>";

				$counter++;
			}
		}

		return $table;
	}
}