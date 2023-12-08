<?php

declare(strict_types=1);

namespace Geekmusclay\Algorithms\Tree;

use Geekmusclay\Algorithms\Interfaces\NodeInterface;

class LinkedList
{
	private NodeInterface $head;
	private ?NodeInterface $tail;
	private int $length;

	public function __construct(NodeInterface $head)
	{
		$this->head = $head;
		$this->tail = $this->head;
		$this->length = 1;
	}

	public function append(NodeInterface $node): self
	{
		$this->tail->setNext($node);
		$this->tail = $node;
		$this->length++;

		return $this;
	}

	public function prepend(NodeInterface $node): self
	{
		$previous = $this->head;
		$this->head = $node;
		$this->head->setNext($previous);
		$this->length++;

		return $this;
	}

	public function insert(NodeInterface $node, ?int $position = null): self
	{
		if (null === $position || $position >= $this->length) {
			return $this->append($node);
		}

		if ($position < 0) {
			return $this->prepend($node);
		}

		$previous = null;
		$current = $this->head;
		$index = 0;
		while ($index !== $position) {
			$previous = $current;
			$current = $current->getNext();
			$index++;
		}

		$previous->setNext($node);
		$node->setNext($current);
		$this->length++;

		return $this;
	}

	public function remove(mixed $searched): self
	{
		$previous = null;
		$current = $this->head;
		while (null !== $current) {
			$value = $current->getValue();
			if ($value === $searched && null === $previous) {
				$this->head = $current->getNext();
				$this->length--;

				return $this;
			}

			if ($value === $searched && null !== $previous) {
				$next = $current->getNext();
				$previous->setNext($next);
				if (null === $next) {
					$this->tail = $previous;
				}
				$this->length--;

				return $this;
			}
			$previous = $current;
			$current = $current->getNext();
		}

		return $this;
	}

	public function reverse(): self
	{
		if (1 >= $this->length || null === $this->head) {
			return $this->head;
		}
		$first = $this->head;
		$this->tail = $this->head;

		$second = $this->head->getNext();
		while (null !== $second) {
			$tmp = $second->getNext();
			$second->setNext($first);
			$first = $second;
			$second = $tmp;
		}
		// Otherwise we could get endless reference
		$this->head->setNext(null);
		$this->head = $first;

		return $this;
	}

	public function getList(): array
	{
		$result = [];
		$current = $this->head;
		while (null !== $current) {
			$result[] = $current->getValue();
			$current = $current->getNext();
		}

		return $result;
	}
}
