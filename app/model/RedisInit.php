<?php
class RedisInit {
    public static function getInstance() {
        static $redis = null;

        if ($redis === null) {
            if (!class_exists('\Redis')) {
                throw new \RuntimeException('phpredis extension is not installed or the Redis class is unavailable.');
            }

            $redis = new \Redis();
            $redis->connect('127.0.0.1', 6379);
        }

        return $redis;
    }
}
