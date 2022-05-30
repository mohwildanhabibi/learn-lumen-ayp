# Project Skeleton

This repository contains the project skeleton which is run with Docker.

## System Requirements

- Docker ^4.x
- Default ports [8082 (app) and 3308 (DB)] must be available, otherwise, it needs adjustment on the exposed ports.

## Setup

- Copy environment files by running `cp .env.example .env`.
- Run `docker-compose up -d`.
- Connect to your docker CLI for 'ayp-group-app' container, and input 'php artisan migrate' or 'php artisan migrate:fresh'
- If there are no issues, your app should run `http://localhost:8082`.
- Your database should run on port `3308`. Here are the default credentials:

```
HOST=localhost
PORT=3308
USERNAME=root
PASSWORD=ayp-group
```
