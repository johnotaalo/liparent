<?php

namespace LIPARENT\Library;
// 
use \Phalcon\Mvc\User\Component;
use \Phalcon\Mvc\View;

require_once __DIR__ .'/../third_party/swiftmailer/lib/swift_required.php';

class Mail extends Component
{
	protected $_transport;

	public function getTemplate($name, $params)
	{
		$parameters = array_merge(array(
			'publicUrl' => $this->config->app->base_url,
		), $params);
		return $this->_view->getRender('emailTemplates', $name, $parameters, function($view){
			$view->setRenderLevel(View::LEVEL_LAYOUT);
		});

		return $view->getContent();
	}

	public function send($to, $subject, $name, $params)
	{
		$mailSettings = $this->config->mail;

		$template = $this->getTemplate($name, $params);
		// echo $template;die;

		//creating the message
		$message = \Swift_Message::newInstance()
					->setSubject($subject)
					->setTo($to)
					->setFrom(array(
						$mailSettings->fromEmail => $mailSettings->fromName
					))
					->setBody($template, 'text/html');

		if (!$this->_transport) {
			$this->_transport = \Swift_SmtpTransport::newInstance(
				$mailSettings->smtp->server,
				$mailSettings->smtp->port,
				$mailSettings->smtp->security
			)
			->setUsername($mailSettings->smtp->username)
			->setPassword($mailSettings->smtp->password);
		}

		//create the mailer using the created transport
		$mailer = \Swift_Mailer::newInstance($this->_transport);

		return $mailer->send($message);
	}
}