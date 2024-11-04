<?php

namespace App\Services;

use App\Database\Redis;

class PrometheusService
{
    private $prometheusRegistry;
    private $prometheusRequestCounter;
    private $prometheusHttpStatusCounter;

    public function __construct()
    {
        $this->prometheusRegistry = (new Redis())->initializePrometheus();
        $this->prometheusRequestCounter = $this->prometheusRegistry->registerCounter('api', 'requests_total', 'Total number of requests');
        $this->prometheusHttpStatusCounter = $this->prometheusRegistry->registerCounter('api', 'http_responses_total', 'Total number of HTTP responses', ['status', 'endpoint']);
    }

    public function getRegistry()
    {
        return $this->prometheusRegistry;
    }

    public function registerCounterRequest()
    {
        $this->prometheusRequestCounter->inc();
    }

    public function registerCounterHTTPStatus($status, $path)
    {
        $this->prometheusHttpStatusCounter->inc(['status' => $status, 'endpoint' => $path]);
    }
}
