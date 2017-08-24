<?php

namespace LordDashMe\MailChimp\Subscriber;

abstract class SubscriberAbstract
{
	protected $listId;

	public function setListId($listId)
	{
		$this->listId = $listId;
	}

	public function getListId()
	{
		return $listId;
	}
}