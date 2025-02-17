# Wakbook

## Getting Started

1. Run `docker compose build --no-cache` to build fresh images
2. Run `docker compose up --pull always -d --wait` to set up and start a fresh Symfony project
3. With xdebug enabled, run `$env:XDEBUG_MODE="debug"; docker compose up --pull always -d --wait; $env:XDEBUG_MODE=""`
4. Run `docker compose down --remove-orphans` to stop the Docker containers.
5. PHP container `docker exec -it wakbook-php-1 bash`
