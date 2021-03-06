<?php

namespace TenantCloud\Emailer\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use TenantCloud\Emailer\Contracts\ContactsContract;
use TenantCloud\Emailer\Response;

/**
 * Class Contacts
 */
class Contacts implements ContactsContract
{
	private string $url = 'contacts';

	private Client $httpClient;

	public function __construct(Client $httpClient)
	{
		$this->httpClient = $httpClient;
	}

	public function store(array $data): Response
	{
		try {
			$response = $this->httpClient->post($this->url, [
				'form_params' => $data,
			]);
		} catch (RequestException $e) {
			$response = $e->getResponse();
		}

		return new Response($response);
	}

	public function update(int $id, array $data): Response
	{
		try {
			$response = $this->httpClient->put("{$this->url}/{$id}", [
				'form_params' => $data,
			]);
		} catch (RequestException $e) {
			$response = $e->getResponse();
		}

		return new Response($response);
	}

	public function delete(int $id): Response
	{
		try {
			$response = $this->httpClient->delete("{$this->url}/{$id}");
		} catch (RequestException $e) {
			$response = $e->getResponse();
		}

		return new Response($response);
	}
}
