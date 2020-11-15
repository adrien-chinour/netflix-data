# Netflix data

## Get your Netflix data

Go on this page [https://www.netflix.com/account/getmyinfo](https://www.netflix.com/account/getmyinfo) and request a data copy.
When data is ready just download and export on data folder.

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
