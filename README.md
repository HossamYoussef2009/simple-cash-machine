# Simple Cash Machine

A micro-service to validate and run simple cash-machine transaction in Silex 2.


## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.


### Prerequisites

- Composer
- PHP  >= 5.6.4
- PHPUnit
- Postman Chrome: Nice tool for testing APIs. 


**There are useful links**:
```
- http://silex.sensiolabs.org/doc/2.0/
- https://phpunit.de/manual/current/en/installation.html
- https://www.getpostman.com/
```

## Important Notes
- this API has been built as an extra feature without changing the main requirements of generating the different exception.
Please check the test function of 'src/Controllers/CashWithdraw.php' Class.

### Build & Run Docker Container

1- Optional: build and run the service using Docker container

```
docker-compose build
```

```
docker-compose up -d
```
please change the port "8070" according to your preferences.


## Running the tests

##  A- Test the given value using Shell cURL 
```
curl --request GET \
  --url http://simple-cash-machine.dev:8070/cash-withdraw/80
```

**GET /cash-withdraw/{amount}**

**Use:**
- Display available cash notes.

**Implementation Notes:**
- Returns a array list of all available cash notes and show if is there an exception message.
- Response Messages

    * 200	:Ok Response.
    * 404	:Not Found.
    * 403	:NotAvailable

** Parameter** (At least one of the following parameters):
- Amount: (Optional, Default is null)
 

##  B- Run PHPUnit test
```
 php vendor/bin/phpunit
 ```

You can run the exist test files with
 ```
 phpunit
 ```

## TODO
- GUI
- Apply swagger api tool for the documentation.

## Authors

* **Hossam Youssef** - *PHP Developer*

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE) file for details


