This is an example with **The Clean Architecture** principles and patterns. It calculates gross price of selected items from Amazon.  
- exec: `php app.php -f {amazon_url} -f {amazon_url} -f {amazon_url}`  

<br/>

### LAYERS

#### Domain layer

>Domain layer is core of the application. It defines enterprise-wide domain objects, services
and interfaces for outer layers. Domain objects encapsulate core business logic and are less
likely to change by changes from external world. They should be plain old PHP Objects which are 
language specific only (i.e. should not depend on tools such as frameworks, libs). 

#### Application layer

>Application layer defines Use Cases (application specific) which in turn uses domain objects 
and services to fulfill user's requests. Use Case should be stateless (i.e. should not hold business 
data between requests) which help applications to scale.

#### Infrastructure

>Which are external tools and adapters. Infra implements interfaces defined by domain and application
layers. Tools should be at infrastructure layers such as Database access, Http client, etc.

#### UI

>Which takes user's input, convert into application layer input (use case input), invokes the 
use case and renders output to client (web view, command line, etc).  

<br/>

### CODING PRINCIPLES

- **Dependency Inversion**: higher-level modules should not depend on lower-level modules,
both should depend on abstractions. I.e. Application services should not depend
on implementation details by Infrastructure/UI layer, instead they should define interfaces
for the outer layers to implement. 
Then by using an IoC containers will help to inject dependencies (dependency injection)
into our Application services.

- **Code to Interfaces**: defines WHAT (interfaces) before HOW (implementation. And we're going to need lots
of helper methods for the HOW).

- **Composition over Inheritance**: instead of keep extending from a base class (overriding
and adding new behaviors) we should break into classes with singl)e responsibility
and composing them (has-a relationship) to archive desired functionality. This allow our code to be more flexible
and maintainable.