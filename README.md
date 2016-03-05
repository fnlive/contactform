Contactform a PHP module for contact forms.
==================================

This is a contact form module for the Anax-MVC framework.

* Add a contact form to any page via the ContactFormController class as dispatcher.
* Add a contact form message administration section to a page via the ContactFormAdminController class as dispatcher.

See contactform/webroot/testContactform.php for example usage.

* [Contactform@Git](https://github.com/fnlive/contactform)
* [Contactform@Packagist](https://packagist.org/packages/fnlive/contactform)

Installation
--------------------
* Download [Anax-MVC release v.04](https://github.com/fnlive/Anax-MVC/releases/tag/v0.4) or later.
* Add following lines to Anax-MVC/composer.json, see below
* run composer update to download module and dependencies to vendor folder
* copy template files from vendor/fnlive/contactform/view/contactform/* to Anax-MVC/app/view/contactform/*
* point your browser to file vendor/fnlive/contactform/webroot/testContactform.php to try out module

        "require": {
            "php": ">=5.4",
            "mos/cform": "2.*@dev",
            "mos/cdatabase": "dev-master",
            "fnlive/contactform":  "dev-master"
        },

This module is dependent on [mos/cform](https://github.com/mosbth/cform) and [mos/cdatabase](https://github.com/mosbth/cdatabase).

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
