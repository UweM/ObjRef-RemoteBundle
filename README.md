# ObjRef RemoteBundle
Symfony Bundle of my [ObjRef](https://github.com/UweM/ObjRef) remote php objects

Check out my [ExampleBundle](https://github.com/UweM/ObjRef-ExampleBundle) for a working demo

## Installation
Just run `composer require uwem/objref-remotebundle` and enable the bundle in the kernel:
```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = [
        // ...
        new ObjRef\RemoteBundle\ObjRefRemoteBundle(),
        // ...
    ];
}
```
## Testing
You can run the tests in any suitable symfony installation using phpunit

