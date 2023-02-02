<?php

namespace Laracasts\Transcriptions;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonSerializable;

class Lines implements Countable, IteratorAggregate, ArrayAccess, JsonSerializable
{
    public function __construct(protected array $lines)
    {
        //
    }

    public function asHtml()
    {
        $formattedLines = array_map(
            fn(Line $line) => $line->toHtml(),
            $this->lines
        );

        return (new static($formattedLines))->__toString();
    }

    public function count(): int
    {
        return count($this->lines);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->lines);
    }

    public function __toString(): string
    {
        return implode("\n", $this->lines);
    }

    public function offsetExists($key)
    {
        return isset($this->lines[$key]);
    }

    public function offsetGet($key)
    {
        return $this->lines[$key]; 
    }

    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->lines[] = $value;
        } else {
            $this->lines[$key] = $value;
        }
    }

    public function offsetUnset($key)
    {
        unset($this->lines[$ley]);
    }

    public function jsonSerialize()
    {
        return $this->lines;
    }
}