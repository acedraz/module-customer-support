# CUSTOMER SUPPORT - M2 #

Magento 2 module for customer support

### Instalation ###

* Composer

Add in 'repositories' of composer.json (magento 2 project):

     "repositories": {
        "acedraz-customer-support": {
            "url": "https://github.com/acedraz/module-customer-support.git",
            "type": "git"
        }
     }

Make a require:

    composer require acedraz/module-customer-support:^1.0

* Manually

  Copy files to root/app/code/ACedraz/CustomerSupport/

### IMPORTANT ###

Run this command in magento cli terminal (if necessary)

    php bin/magento module:enable ACedraz_CustomerSupport
    php bin/magento setup:upgrade
