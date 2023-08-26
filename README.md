# Tablemancer

Tablemancer is a PHP library designed to simplify database table management. It provides essential tools for handling CRUD (Create, Read, Update, Delete) operations, working with JSON data, and maintaining security in your database interactions.

## Features

-  **CRUD Operations**: Easily create, read, update, and delete records in your database tables.

-  **JSON Data Handling**: Seamlessly manage JSON data, making it convenient to work with complex structured data.

-  **Security**: Tablemancer includes security measures to protect against common vulnerabilities, ensuring the safety of your data.

## Requirements

- PHP 8.0 or higher

## Installation

You can install Tablemancer using [Composer](https://getcomposer.org/):

```bash

composer  require  retamayo/tablemancer

```

## Usage

Here's a quick example of how to use Tablemancer to create a new record in your database:

```php
<?php

require  'vendor/autoload.php';

use Retamayo\Tablemancer\Facade;
use Retamayo\Tablemancer\Table;

// Create a database connection (replace with your own connection)
$pdo = new  \PDO("mysql:host=localhost;dbname=mydatabase", "username", "password");

// Initialize Tablemancer
$tablemancer = new  Facade($pdo);

// Create a new Table Object
$tableInstance = new  Table(
    name: 'tableName',
    columns: [
        'name',
        'age'
    ],
    primary: 'id',
    sensitive: []
);

// Add the new Table object to the Schema class.
$tablemancer->addTable('tableName', $tableInstance);

// Create a new record on the database.
$tablemancer->create('tableName', ["name" => "tablemancer", "age" => "100"]);

```

For more detailed information and examples, please refer to the [documentation](https://tablemancer.vercel.app) or explore the codebase.

## License

Tablemancer is open-source software released under the [MIT License](LICENSE).

## Contribution

Contributions are welcome! If you encounter issues or have suggestions for improvements, please open an [issue](https://github.com/RE-Tamayo/tablemancer/issues) or submit a [pull request](https://github.com/RE-Tamayo/tablemancer/pulls).

## Contact

If you have questions or need assistance, you can reach me at [rosas.emerjoe.tamayo@gmail.com](mailto:rosas.emerjoe.tamayo@gmail.com).

Happy coding!
