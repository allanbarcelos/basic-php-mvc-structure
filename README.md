# PHP Basic Structure

CHECK LEA PLATFORM FOR ASSIGNMENTS 

## DW3 LaSalle

- Web Server Application course

```
app/
│── config/
│   └── config.php
│── controllers/
│   ├── AuthController.php
│   ├── HomeController.php
│   ├── TaskController.php
│   └── UserController.php
│── core/
│   ├── App.php
│   ├── Controller.php
│   ├── Database.php
│   ├── Middleware.php
│   └── Model.php
│── models/
│   ├── Task.php
│   └── User.php
│── views/
│   ├── auth/
│   │   └── login.php
│   ├── home.php
│   ├── layouts/
│   │   ├── footer.php
│   │   ├── header.php
│   │   └── sidebar.php
│   ├── task/
│   │   └── index.php
│   ├── user/
│   │   ├── create.php
│   │   ├── edit.php
│   │   └── index.php
public/
│── css/
│   └── styles.css
│── images/
│── js/
│   ├── datatables-simple-demo.js
│   └── scripts.js
│── .htaccess
│── index.php

```


### Not in Exam
- Composer
- Git


## Composer: [Composer - Dependency Management](https://getcomposer.org/)

### To Start a new
```shell
composer init
```

### To install the dependencies
```shell
composer install
```

### To add a new dependency
```shell
composer require <DEPENDENCY NAME>
```

## Functions

### ucfirst


Make a string's first character uppercase

```php
<?php
function ucfirst(string $string): string { }
@param string $string — The input string.
@return string — the resulting string.
@link https://php.net/manual/en/function.ucfirst.php
```

Make a string's first character uppercase

```php
ucfirst( string $str ): string
```

### extract(Array())
```php
$array = ['users' = > []]
extract($array);

// The extract will create variable with the keys of array
// $users = []
```

## Authentication X Authorization
- Authentication  give to you the possibility to access (username, password)
- Authorization its the method to verify if you have the correct credentials to access some resource

**Example**
- User --> can see but can`t edit or make changes
- Admin --> can see and make changes

# Apache configuration

```xml
<!-- OR your specific folder -->
<Directory "/home/ubuntu/www">
    Options Indexes FollowSymLinks Includes ExecCGI
    AllowOverride All
    Require all granted
</Directory>
```

## [AWS Step-By-Step](AWS.md)