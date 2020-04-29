
# APP
Applying Clean Architecture principles and patterns   

app.php is basically bootstrapping and then forwards the users' requests to the corresponding views/controllers.

  - To exec the app please run:  
    php app.php -f {amazon_url} -f {amazon_url} -f {amazon_url}

## DOMAIN LAYER:
Define the domain objects, domain services, repository interfaces, domain-specific exceptions, domain-level configs.  
The domain object properties should be privated with setter, getter.  
Domain layer should not depend on infra, application layers. Both should depend on abstractions (interfaces defined by domain layer).

Configuration: the config loader (Singleton) that in turn loads config values from config.ini file, 
could be improved to load from env variables for deploying on multiple environments.

## APPLICATION LAYER:
UseCase: define interface for use cases (function execute(UseCaseInput $input): UseCaseOutput)   
UseCaseInput: abstract base class for use cases input with a $id property and force child classes to implement validate() function.
UseCaseOutput: abstract base class for use cases output.

GrossPriceUseCase: the desired use case which implements UseCase interface.
Use cases should handle domain-level and application-level exceptions (internal domain data should not be leaked to outside) and may throw an use case specific exception for the view to know.

GrossPricePresenterCLI: this presenter is to adapt the use case output to the CLI view.

## INFRA:
WebItemRepository: implements ItemRepository interface. It takes the $url and returns Item object.
Tried some DOM parses with the Amazon pages but it did not work as expected so I choose to use regex instead. Could improve performance by using multithreading, async mechanism.

Repo should handle infra exceptions and may throw domain-level or application-level exceptions for the layers to handle.

## UI:
GrossPriceCLI: the command line view. It takes user input, transforms to the use case input,
exec the use case, invokes the presenter to adapt the use case output and the response to users.



