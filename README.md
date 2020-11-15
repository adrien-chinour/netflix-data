# Netflix data

## Get your Netflix data



## Installation
1. Put your netflix export data in data folder.

2. Install dependencies :
```bash
# With docker
docker-compose run --rm app composer install

# Without docker
composer install
```

## Usage

```bash
# With docker
docker-compose run --rm app php application.php

# Without docker
php application.php
```

> This command will prompt you available commands.
