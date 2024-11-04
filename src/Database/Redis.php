<?php

namespace App\Database;

use Prometheus\CollectorRegistry;
use Prometheus\Storage\Redis as PrometheusRedis;

class Redis
{
    private string $host;
    private string $port;

    public function __construct()
    {
        $this->host = $_ENV['REDIS_HOST'];
        $this->port = $_ENV['REDIS_PORT'];
    }

    public function initializePrometheus()
    {
        $redisAdapter = new PrometheusRedis([
            'host' => $this->host,
            'port' => $this->port
        ]);
        
        return new CollectorRegistry($redisAdapter);
    }
}
