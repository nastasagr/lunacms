<?php

namespace Luna\Core\Installer;

class InstallChecker
{
    public function __construct(
        private string $configPath,
        private string $lockPath
    ) {
    }

    public function installed(): bool
    {
        return file_exists($this->configPath) && file_exists($this->lockPath);
    }
}
