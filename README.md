# Api Webshop

## Installation

Clone the repo: ``` git clone https://github.com/edmondzahiti/calculator.git ```

```cd``` into the folder generated

Run ```copy .env.example .env``` and after that update database credentials in ```.env``` file

Execute commands as below:

```sh 
composer install
./vendor/bin/sail build --no-cache
./vendor/bin/sail up
php artisan key:generate
php artisan jwt:secret
./vendor/bin/sail php artisan migrate:fresh --seed
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```


#### I've implemented the following components in your Laravel application:

```sh 
- Controller: CalculatorController manages HTTP requests and delegates operations to the service layer.

- Service Layer (CalculatorService): It contains order-related business logic, such as calculation, getting history etc.

- Repository Layer (HistoryRepository): This layer abstracts database operations for history, ensuring separation of concerns.

- Request Validation: Laravel's request validation classes ensure incoming data meets specified criteria.

- Collections and Resources: I've implemented collections and resources to format and structure API responses consistently.
```


#### Note

```sh 
 This calculator has been implemented without relying on 'eval' or external packages such as symfony/expression-language.
 While using 'eval' or expression language packages might seem like a shortcut, especially for mathematical expressions,
 they introduce significant security risks, especially in a sensitive environment like a payment processor.
 
 Reasons for avoiding 'eval' and similar packages:
  1. Security Risk: 'eval' allows execution of arbitrary code, posing a potential threat to the application's security.
  2. Code Maintainability: Using 'eval' or complex expression language packages can make the code harder to maintain and understand.
  3. Performance: Implementing a custom solution ensures optimized performance for basic arithmetic operations.
  
 By developing this calculator from scratch, we prioritize security and maintainability, crucial factors in handling sensitive data.
 This approach may require more initial effort, but it ensures a robust foundation for future development and integration.
  
 If you have any questions or concerns, feel free to reach out for further clarification.

```
