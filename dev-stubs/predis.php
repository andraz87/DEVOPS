<?php
/**
 * Predis client stub for IDE/static analysis.
 * Declared only if Predis is not installed.
 */

namespace Predis {
    if (!class_exists('Predis\\Client')) {
        class Client {
            public function __construct($parameters = null, $options = null) {}
            public function setex(string $key, int $ttl, $value) {}
            public function get(string $key) {}
            public function del(string $key) {}
        }
    }
}
