<?php
class RedisService {
    private static $redis = null;

    // Pridobi Redis klienta
    private static function connect() {
        if (self::$redis === null) {
            self::$redis = new Redis();

            // Privzeto localhost
            $host = '127.0.0.1';
            $port = 6379;

            // Če smo v Docker okolju, nastavimo hostname na "redis"
            if (getenv('DOCKER_ENV') === 'true') {
                $host = 'redis';
            }

            try {
                self::$redis->connect($host, $port);
            } catch (Exception $e) {
                die("Napaka pri povezavi na Redis ($host:$port): " . $e->getMessage());
            }
        }
        return self::$redis;
    }

    // Shrani podatke v cache
    public static function set($key, $value, $ttl = 300) {
        $r = self::connect();
        $r->setex($key, $ttl, json_encode($value));
    }

    // Preberi podatke iz cache
    public static function get($key) {
        $r = self::connect();
        $data = $r->get($key);
        return $data ? json_decode($data, true) : null;
    }

    // Izbriši podatke iz cache
    public static function delete($key) {
        $r = self::connect();
        $r->del($key);
    }
}
