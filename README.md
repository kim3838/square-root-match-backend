
# Square root match list

## Overview

This project is a web application built with Laravel.

## Features

**Input Square Root Combination**: List the combinations of squared value of input as C² as A² + B² = C² and Average of A,B, and C

Where input = 25
Will response an array of object of

- 0² + 5² = 5² avg = 3
- 3² + 4² = 5² avg = 4

```
[
    {"value":25,"a":0,"b":5,"c":5,"avg":3},
    {"value":25,"a":3,"b":4,"c":5,"avg":4}
]
```

## Requirements

- PHP 8.2
- Mysql
- Composer

## Installation

To get started, clone the repository and install the necessary dependencies:

```
composer install
php artisan migrate
php artisan key:generate
```

Set your Mysql credentials on .env file located under the root folder

Then serve the project as you like

```
php artisan serve --port=80
```

will be hosted as 'http://localhost:80'
