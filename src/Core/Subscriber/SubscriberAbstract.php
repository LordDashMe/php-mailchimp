<?php

/**
 * The Subscriber Abstract Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 24, 2017
 */

namespace LordDashMe\MailChimp\Core\Subscriber;

abstract class SubscriberAbstract
{
	/**
	 * The mailchimp developer api key field.
	 *
	 * @var string
	 */
	protected $apiKey;

	/**
	 * The mailchimp list id field.
	 *
	 * @var string
	 */
	protected $listId;

	/**
	 * The data field.
	 *
	 * @var json
	 */
	protected $data;

	/**
	 * The setter method for the api key field.
	 *
	 * @param  string  $apiKey
	 *
	 * @return $this
	 */
	public function setApiKey($apiKey)
	{
		$this->apiKey = $apiKey;

		return $this;
	}

	/**
	 * The getter method for the api key field.
	 *
	 * @return string
	 */
	public function getApiKey()
	{
		return $this->apiKey;
	}

	/**
	 * The setter method for list id field.
	 *
	 * @param  string  $listId
	 *
	 * @return $this
	 */
	public function setListId($listId)
	{
		$this->listId = $listId;

		return $this;
	}

	/**
	 * The getter method for the list id field.
	 *
	 * @return string
	 */
	public function getListId()
	{
		return $this->listId;
	}

	/**
	 * The setter method for data field.
	 *
	 * @param  string  $data
	 *
	 * @return $this
	 */
	public function setData($data)
	{
		$this->data = $data;

		return $this;
	}

	/**
	 * The getter method for the data field.
	 *
	 * @return string
	 */
	public function getData()
	{
		return $this->data;
	}
}