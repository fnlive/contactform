Contactform a PHP module for contact forms.
==================================

This is a contact form module for the Anax-MVC framework.

Add a contact form to any page via the ContactFormController class as dispatcher. Add a contact form message administration section to a page via the ContactFormAdminController class as dispatcher. See contactform/webroot/testContactform.php for example usage.

* [Git](https://github.com/fnlive/contactform)
* [Packagist](https://packagist.org/packages/fnlive/contactform)

Installation
--------------------
Download latest release from git and unxip it under folder ../Anax-MVC/vendor/fnlive/. You can also  install it from Packagist through [Composer](https://getcomposer.org/). If using Composer, add following line to your composer.json file:

    "require": {
        "php": ">=5.4",
        "mos/cform": "2.\*@dev",
        "mos/cdatabase": "dev-master",
        "fnlive/contactform":  "dev-master"
    },

This module are dependent on [mos/cform](https://github.com/mosbth/cform) and [mos/cdatabase](https://github.com/mosbth/cdatabase). 

By Fredrik Nilsson (fn@live.se)



License
----------------------------------

This software is free software and carries a MIT license.



Todo
----------------------------------

* Add extension for enabling sending av message through mail-service to arbitrary receiver.
* Add support for storing and retrieval of Contact details from database.
* Add unit testing for module.


History
----------------------------------

v1.0 (2016-03-05)


```
 .   
..:  Copyright 2016 by Fredrik Nilsson (fn@live.se)
```
