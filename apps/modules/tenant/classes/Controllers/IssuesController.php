<?php

namespace LIPARENT\Tenant\Controllers;

use LIPARENT\Common\Controllers\BaseController as Controller;

use LIPARENT\Common\Models\Issue;
use LIPARENT\Common\Models\Tenant;

class IssuesController extends Controller{

	public function indexAction(){
		$this->view->content = $this->_view->getPartial('issues/index');
	}

	public function addReportAction(){
		$this->view->disable();
		if ($this->request->isPost()) {
			$tenant = Tenant::findFirstByUserId($this->session->get('user_id'));
			$issueTitle = $this->request->getPost('issueTitle');
			$issueDescription = $this->request->getPost('issueDescription');

			$issue = new Issue();

			$issue->issueTitle = $issueTitle;
			$issue->issueDescription = $issueDescription;
			$issue->tenant_id = $tenant->id;

			$issue->save();

			$this->flashSession->success('Issue Reported Successfully');

			$this->response->redirect($this->url->get('tenant/issues'), true);
		}
	}
}