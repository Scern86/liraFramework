# Lira
A small PHP framework for prototyping and developing web applications.

# Feature list:
- Authorization, assigning groups and roles to users. Access control.
- Full localization support for the entire application.
- Request routing using path-based regular expressions (SEF).
- Separation of code into layers: Core, Application and Module(s).
- Ability to connect to multiple databases, caching services.
- Loading configuration from files or database (expandable list of sources).
- Support for events, creating subscribers.
- Internal request redirection, restarting routing to a new path if further processing is required.
- Monolog based logging, event listener.
- Request/Response based on Symfony/Http-Foundation
- Support for GET/POST/PUT/DELETE HTTP methods.
- Ability to implement RESTful.

# Technologies and extensions
- nginx
- PHP-FPM
- PHP 8.2
- Memcached
- MongoDB
- Composer
- Monolog
- Symfony HTTP Foundation

# Extra
Uses PHP 8.2 features, namespaces, PSR-4 autoloading, PSR-12 coding style.

# Installation
There is no installer.

# License
The Lira platform is licensed under the [MIT](LICENSE) license.
