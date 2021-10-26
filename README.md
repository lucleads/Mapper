# Mapper

[![PHP](https://img.shields.io/badge/LANGUAGE-PHP-green.svg)](https://www.php.net/)

[![Github Follow](https://img.shields.io/github/followers/lucleads?style=social)](https://github.com/lucleads)

## Description

Library that automatically copies the attributes of an object to a Data Transfer Object.

This library works in a similar way to libraries like MapStruct in other languages such as Java.

## DEPLOY

To deploy de application modify de `.env` file located in the project root with your local settings, open a terminal in the root directory and execute the next command:

- `docker-compose up -d` *[to build and deploy the docker container]*

**NOTE:** If you don't modify the `.env` file, the default values are:

- **Container name:** dto-mapper
- **Php version:** 8.0.10
- **Deployable port:** 81

## REQUIREMENTS

Needed to deploy the proyect:

- [Docker engine](https://docs.docker.com/engine/install/)
- [Docker compose](https://docs.docker.com/compose/install/)

Tools used in docker build *(Don't need previous installation)*:

- [Composer](https://getcomposer.org/download/)
- [Xdebug](http://xdebug.org/)

**NOTE:** The PHP version established in the `.env` file must be 8.0 or higher.
