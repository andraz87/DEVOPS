<?php
class RedisInit {
    public static function getInstance() {
        static $redis = null;
        static $REDIS_HOST = getenv('REDIS_HOST') ?: '127.0.0.1';

        if ($redis === null) {
            if (!class_exists('\Redis')) {
                throw new \RuntimeException('phpredis extension is not installed or the Redis class is unavailable.');
            }

            $redis = new \Redis();
            $redis->connect($REDIS_HOST, 6379);
        }

        return $redis;
    }
}
