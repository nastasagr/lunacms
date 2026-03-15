<?php

namespace Luna\Core;

class Session
{
    public function __construct()
    {
        $this->start();
    }

    public function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['_flash'] ??= [
            'new' => [],
            'old' => [],
        ];
    }

    public function all(): array
    {
        return $_SESSION;
    }

    public function exists(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }

    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    public function put(string|array $key, mixed $value = null): void
    {
        if (is_array($key)) {
            foreach ($key as $sessionKey => $sessionValue) {
                $_SESSION[$sessionKey] = $sessionValue;
            }

            return;
        }

        $_SESSION[$key] = $value;
    }

    public function push(string $key, mixed $value): void
    {
        $array = $this->get($key, []);
        $array[] = $value;

        $_SESSION[$key] = $array;
    }

    public function increment(string $key, int $amount = 1): int
    {
        $value = (int) $this->get($key, 0) + $amount;
        $_SESSION[$key] = $value;

        return $value;
    }

    public function decrement(string $key, int $amount = 1): int
    {
        return $this->increment($key, -$amount);
    }

    public function pull(string $key, mixed $default = null): mixed
    {
        $value = $this->get($key, $default);
        $this->forget($key);

        return $value;
    }

    public function forget(string|array $keys): void
    {
        foreach ((array) $keys as $key) {
            unset($_SESSION[$key]);
        }
    }

    public function flush(): void
    {
        $_SESSION = [
            '_flash' => [
                'new' => [],
                'old' => [],
            ],
        ];
    }

    public function invalidate(): void
    {
        $this->flush();
        session_regenerate_id(true);
    }

    public function regenerate(bool $destroy = false): bool
    {
        return session_regenerate_id($destroy);
    }

    public function token(): string
    {
        if (!$this->has('_token')) {
            $this->put('_token', bin2hex(random_bytes(32)));
        }

        return $this->get('_token');
    }

    public function regenerateToken(): string
    {
        $token = bin2hex(random_bytes(32));
        $this->put('_token', $token);

        return $token;
    }

    public function flash(string $key, mixed $value = true): void
    {
        $this->put($key, $value);
        $this->mergeFlashNew([$key]);
        $this->removeFromFlashOld([$key]);
    }

    public function now(string $key, mixed $value): void
    {
        $this->put($key, $value);
        $this->mergeFlashOld([$key]);
        $this->removeFromFlashNew([$key]);
    }

    public function reflash(): void
    {
        $old = $this->getFlashOld();
        $this->mergeFlashNew($old);
        $this->putFlashOld([]);
    }

    public function keep(array|string $keys): void
    {
        $keys = (array) $keys;

        $this->mergeFlashNew($keys);
        $this->removeFromFlashOld($keys);
    }

    public function ageFlashData(): void
    {
        $this->forget($this->getFlashOld());

        $this->putFlashOld($this->getFlashNew());
        $this->putFlashNew([]);
    }

    public function flashInput(array $input): void
    {
        $this->flash('_old_input', $input);
    }

    public function old(string $key = null, mixed $default = null): mixed
    {
        $old = $this->get('_old_input', []);

        if ($key === null) {
            return $old;
        }

        return $old[$key] ?? $default;
    }

    public function errors(): array
    {
        return $this->get('errors', []);
    }

    public function error(string $key, mixed $default = null): mixed
    {
        return $this->errors()[$key] ?? $default;
    }

    public function hasError(string $key): bool
    {
        return array_key_exists($key, $this->errors());
    }

    private function getFlashNew(): array
    {
        return $_SESSION['_flash']['new'] ?? [];
    }

    private function getFlashOld(): array
    {
        return $_SESSION['_flash']['old'] ?? [];
    }

    private function putFlashNew(array $keys): void
    {
        $_SESSION['_flash']['new'] = array_values(array_unique($keys));
    }

    private function putFlashOld(array $keys): void
    {
        $_SESSION['_flash']['old'] = array_values(array_unique($keys));
    }

    private function mergeFlashNew(array $keys): void
    {
        $this->putFlashNew(array_merge($this->getFlashNew(), $keys));
    }

    private function mergeFlashOld(array $keys): void
    {
        $this->putFlashOld(array_merge($this->getFlashOld(), $keys));
    }

    private function removeFromFlashOld(array $keys): void
    {
        $this->putFlashOld(array_values(array_diff($this->getFlashOld(), $keys)));
    }

    private function removeFromFlashNew(array $keys): void
    {
        $this->putFlashNew(array_values(array_diff($this->getFlashNew(), $keys)));
    }
}
