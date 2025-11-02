<?php
/**
 * Global Redis extension stub for IDE/static analysis.
 * Declared only if the real Redis extension is not available.
 */

if (!class_exists('Redis')) {
    class Redis {
        public function connect(string $host, int $port = 6379) {}
        public function setex(string $key, int $ttl, $value) {}
        public function get(string $key) {}
        public function del(string $key) {}
    }
}
