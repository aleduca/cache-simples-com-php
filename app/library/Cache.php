<?php

namespace app\library;

readonly class Cache
{
	public function __construct(private string $name)
	{
	}

	private function crateAndReturn(string $cacheName, $data)
	{
		file_put_contents($cacheName, $data);
		return json_decode($data);
	}

	public function create(string|array $data, int $validateInMinutes = 10)
	{
		$data = json_encode($data);

		$cacheName = $this->name . '.txt';
		if (file_exists($cacheName)) {
			$fileCreated = filemtime($cacheName);
			$expired = strtotime("+{$validateInMinutes} minutes", $fileCreated) < strtotime('now');
			if ($expired) return $this->crateAndReturn($cacheName, $data);
			return json_decode(file_get_contents($cacheName));
		} else {
			return $this->crateAndReturn($cacheName, $data);
		}
	}
}
