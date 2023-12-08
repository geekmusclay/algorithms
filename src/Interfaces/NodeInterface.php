<?php

declare(strict_types=1);

namespace Geekmusclay\Algorithms\Interfaces;

interface NodeInterface
{
	public function __construct(mixed $value, ?NodeInterface $next = null);

	public function getValue(): mixed;

	public function setValue(mixed $value): self;

	public function getNext(): ?NodeInterface;

	public function setNext(?NodeInterface $next): self;
}
