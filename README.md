# Ciconia

If you are concerned about your privacy, but you still want a service that allows you to store images and get a shortlink to it, to share it with your friends, Ciconia is for your. This is what it does.

## Dependency

* composer

## Install

* Download the latest release on GitHub
* Configure your web server according to examples for Apache or Nginx
* Create a user and a database for the service
* `cd CICONIA_DIRECTORY && composer install`
* `cd install/ && ./install.php`

### Add user

To add an user, you just have to go into the script folder, and launch `adduser.php`.

### Delete user

To delete an user, you just have to go into the script folder, and launch `deleteuser.php`

### Gallery Template
#### Creator

Start Bootstrap was created by and is maintained by **David Miller**, Managing Parter at [Iron Summit Media Strategies](http://www.ironsummitmedia.com/).

* https://twitter.com/davidmillerskt
* https://github.com/davidtmiller

Start Bootstrap is based on the [Bootstrap](http://getbootstrap.com/) framework created by [Mark Otto](https://twitter.com/mdo) and [Jacob Thorton](https://twitter.com/fat).

#### Copyright and License

Copyright 2013-2015 Iron Summit Media Strategies, LLC. Code released under the [Apache 2.0](https://github.com/IronSummitMedia/startbootstrap-thumbnail-gallery/blob/gh-pages/LICENSE) license.

### Known error/bugs

* You might need to `chown` the `img/` directory after an user has been added.

