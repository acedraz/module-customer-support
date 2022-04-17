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

### CONFIGURATIONS ###

STORES -> CONFIGURATION -> ACEDRAZ EXTENSIONS -> CUSTOMER SUPPORT

* Configuration

    In here can enable extension functionality and log name

* New Customer Register

    Enable validation and treat for customer fist name

STORES -> CONFIGURATION -> CUSTOMERS -> CUSTOMERS CONFIGURATION -> CREATE NEW ACCOUNT OPTIONS

* Send Emails to Customer Support

    Enable the functionality to send email notification of new accounts to Customer Support (properly configured in STORES -> CONFIGURATION -> GENERAL -> STORE EMAIL ADDRESSES -> CUSTOMER SUPPORT)

* Template Customer Support
    
    Choose a template email for send to customer support
      

    
