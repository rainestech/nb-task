A symfony 6.4 microservice application with docker and docker-compose

## Task Description
Create an application with 2 microservices that communicate via message bus.

Service "users" has an endpoint POST /users and on request with body {"email","firstName","lastName"},
stores the submitted data in a database or in a log file.
When the submitted data is saved, an event is generated and it is sent through a message broker to
the "notifications" service. In "notifications" service the event is consumed and the sent data is saved in a log file.
The code must be covered with tests - unit, integration and functional tests.
Prepare needed containers in docker.
Create README file with instructions.
Upload the code to one repository in Github.

Bonus points if you use DDD or/and CQRS.

## Requirements
- Docker
- Docker Compose
- PHP 8.1
- Make

## Installation
1. Clone the repository
2. in the root directory of the project, run `make install`

## Usage
1. Start the application by running `make start`
2. Open your browser and navigate to `http://localhost:8090` to access the user-service application
3. Notifications service runs on `http://localhost:8100`
4. Open Postman or any other API client and make a POST request to `http://localhost:8090/users` with the following payload:
    ```json
    {
        "email": "john.doe@test.com",
        "firstName": "John",
        "lastName": "Doe"
    }
    ```
5. Check the logs in the `notifications-service` by navigating to the `notifications-service/var/log/service.log` file. You should see the user data that was sent from the `user-service` in the log file. If not, make sure that the `notifications-service` is running and that it's listening and consuming the messages from the message broker (RabbitMQ) by running `make consume-messages`
6. To stop the application, run `make stop`
7. To run the tests, run `make test`
