# Currency Exchanger

## Requirements
- Docker
- Makefile (optional)

## Requirements without docker
- PHP 8.2
- Composer 2
- PHP Extensions: dom, mbstring, curl & zip (to make composer faster)

## Installation
```
make start
```
or
```
docker compose up -d 
docker compose run php composer install
```

## Run tests and quality checks
To run all 
```
make qc
```
or
```
make test 
make phpstan
make phpcs
```

## Todo
- [x] Core domain
    - [x] Calculates a value of exchange with additional strategies that apply fees depending on conditions
- [ ] Application Layer / Facade
   - [ ] Encapsulates business logic and provides a friendly API for interaction
   - [ ] Define use cases or application services for specific actions
- [ ] Infrastructure Layer
   - [ ] Implement repository interfaces defined in the domain layer
   - [ ] Expose HTTP or CLI interfaces for interacting with the business logic