# Dependency Injection

After a bit of reading there is some confusion here because there is a bit of debate on the benefits/downfalls of IoC/DI.

This pattern should just be called "Injector" for what we are doing in my opinion.
What we are doing here is primarily using a detached container to hold items. 

Laravel IoC, Pimple DI are not really "real" Dependency Injectors I am reading, but not certain.

I believe it's recommended to have a Non-Static DI container and pass it where
you need it (such as being linked in a framework). 

For more read: [http://martinfowler.com/articles/injection.html](http://martinfowler.com/articles/injection.html)
And a good example read: [http://auraphp.com/framework/1.x/en/di/](http://auraphp.com/framework/1.x/en/di/)
