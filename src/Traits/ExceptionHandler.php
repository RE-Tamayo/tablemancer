<?php

namespace Retamayo\Absl\Traits;

trait ExceptionHandler
{
    public function formatException($e)
    {
        if ($e instanceof \Exception) {
            echo '<div style="border: 1px solid #ccc; padding: 20px; margin: 0px 20px; background-color: #f9f9f9;">';
            echo '<h1 style="color: #e74c3c;">Exception Details</h1>';
            echo '<p><strong>Error Message:</strong> <span style="color: #333;">' . htmlspecialchars($e->getMessage()) . '</span></p>';
            echo '<p><strong>Exception Type:</strong> <span style="color: #333;">' . get_class($e) . '</span></p>';
            echo '<p><strong>File:</strong> <span style="color: #333;">' . htmlspecialchars($e->getFile()) . '</span></p>';
            echo '<p><strong>Line:</strong> <span style="color: #333;">' . $e->getLine() . '</span></p>';
            echo '<p><strong>Stack Trace:</strong></p>';
            echo '<pre class="stack-trace" style="background-color: #eee; padding: 10px; white-space: pre; color: #333;">' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
            echo '</div>';
        } else {
            echo '<p>Not a valid exception.</p>';
        }
    }
}
