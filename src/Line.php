<?php

namespace Laracasts\Transcriptions;

class Line
{
    public function __construct(
        public int $position,
        public string $timestamp,
        public string $body
    )
    {
        //
    }

    public function toHtml()
    {
        return "<a href=\"?time={$this->beginningTimestamp()}\">{$this->body}</a>";
    }

    public function beginningTimestamp()
    {
        preg_match('/^\d{2}:(\d{2}:\d{2})\.\d{3}/', $this->timestamp, $matches);

        return $matches[1];
    }
}