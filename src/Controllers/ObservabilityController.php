<?php

namespace App\Controllers;

use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;

class ObservabilityController
{
    private $registry;

    public function __construct(CollectorRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * Endpoint do Prometheus
     */
    public function metrics()
    {
        header('Content-Type:' . RenderTextFormat::MIME_TYPE);
        $renderer = new RenderTextFormat();

        $metrics = $this->registry->getMetricFamilySamples();

        if (empty($metrics)) {
            echo "# No metrics to display\n";
            exit;
        }
        echo $renderer->render($metrics);
        exit;
    }
}
