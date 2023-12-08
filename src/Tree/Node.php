<?php

declare(strict_types=1);

use Geekmusclay\Algorithms\Interfaces\NodeInterface;

class Node implements NodeInterface
{
	private mixed $value;
	private ?NodeInterface $next;

	public function __construct(mixed $value, ?NodeInterface $next = null)
	{
		$this->value = $value;
		$this->next = $next;
	}

	public function getValue(): mixed
	{
		return $this->value;
	}

	public function setValue(mixed $value): self
	{
		$this->value = $value;

		return $this;
	}

	public function getNext(): ?NodeInterface
	{
		return $this->next;
	}

	public function setNext(?NodeInterface $next): self
	{
		$this->next = $next;

		return $this;
	}
}
