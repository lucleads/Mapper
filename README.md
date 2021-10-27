# Mapper

[![PHP](https://img.shields.io/badge/LANGUAGE-PHP-green.svg)](https://www.php.net/)

[![Github Follow](https://img.shields.io/github/followers/lucleads?style=social)](https://github.com/lucleads)

## Description

Library that automatically copies the attributes of an object to a Data Transfer Object.

This library works in a similar way to libraries like MapStruct in other languages such as Java.

## DEPLOY

To deploy a sandbox of the library, modify de `.env` file located in the project root with your local settings, open a terminal in the root directory and execute the next command:

- `docker-compose up -d` *[to build and deploy the docker container]*

***NOTE:** If you don't modify the `.env` file, the default values are:

- **Container name:** dto-mapper
- **Php version:** 8.0.10
- **Deployable port:** 81

## HOW TO USE IT

In the path `/src/app/ExampleUseCase` you can find an example of how to implement a mapper.<br>
The purpose of this library is to copy the values of the common fields of two objects.<br> 
For each pair of objects we have to create a mapper class (*Example:* `PersonOutputDtoMapper`).<br>
That mapper class must extend from the abstract class `Mapper` and must contain in its constructor the entity which contains the fields values.<br>
In that class, we can make a function (`map()`) that returns an instance of the class needed, for example a Data Transfer Object class.<br>
The only content of this function should be a static call to its parent class method `mapAutomatically()` with the next parameters:
- **1st parameter:** The source object
- **2nd parameter:** The output object class expected
- **3rd parameter:** `self::class` *(The mapper class)*<br>

To make our mapper find the source for the value of each field, there are three ways to do it:
- The value is in a field with the same name in the source object and in the target object.
- The source object have a getter with the same name of the field of the target object.
  - *Example:* 
    ``` json
    [
      "TargetObject",
      {
        "age": ?
      }
    ]
    ```

    ``` json
     [
        "SourceObject":
        {
           "lifetime": 40
        }
    ]
    ```
    ``` php
    class SourceObject 
    {
        private int $lifetime;
        
        public function getAge(): int
        {
            return $this->lifetime;
        }
    }
    ```
    
- In the  specific MapperClass, we can define the layers to find the value as a class Map attribute.
  - *Example:*
    ``` json
      [
        "TargetObject",
        {
          "age": ?
        }
      ]
      ```
     ``` json
      [
          "SourceObject":
          {
            "Age":
            {
              "value": 40
            }
          }
      ]
      ```

      ``` php
      #[Map('Age.value', 'age')]
      class SourceObjectMapper
      {
          //logic
      }
      ```
  
  ***NOTE:** To define a map attributes, we must follow the next structure:<br>
      `#[Map(` <br>+<br> `layers up the value separated by dots as string`<br>+<br>`,`<br>+<br>`field name in target object as string`<br>+<br>`]`

## REQUIREMENTS

Needed to deploy the proyect:

- [Docker engine](https://docs.docker.com/engine/install/)
- [Docker compose](https://docs.docker.com/compose/install/)

Tools used in docker build *(Don't need previous installation)*:

- [Composer](https://getcomposer.org/download/)
- [Xdebug](http://xdebug.org/)

***NOTE:** The PHP version established in the `.env` file must be 8.0 or higher.
