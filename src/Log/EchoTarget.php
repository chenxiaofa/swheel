<?php

namespace Swheel\Log;


class EchoTarget extends Target
{

    /**
     * Writes log messages to a file.
     *
     */
    public function export()
    {
        echo implode("\n", array_map([$this, 'formatMessage'], $this->messages)) . "\n";

    }

}
