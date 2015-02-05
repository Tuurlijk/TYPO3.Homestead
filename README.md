TYPO3 Homestead
==============================

TYPO3 Homestead is your one-stop TYPO3 development environment. Just run `vagrant up` and a full Linux Ubuntu distribution will be built with all the packages and configuration needed to start development right away. 

Features
--------

TYPO3 Homestead comes with the following stack:
* composer
* hhvm
* mariadb
* nginx
* nodejs
* php-apcu
* php-fpm
* self signed ssl certificates
* xdebug
* xhprof / blackfire
* zsh

Requirements
------------

TYPO3 Homestead uses several roles from the ansible-galaxy:
* nbz4live.php-fpm
* jdauphant.nginx
* geerlingguy.composer
* laggyluke.nodejs

You will need to install these roles before you can run the playbook.

```
ansible-galaxy install -r requirements.yml
```

Variables
--------------

A description of the settable variables for this role should go here, including any variables that are in defaults/main.yml, vars/main.yml, and any variables that can/should be set via parameters to the role. Any variables that are read from other roles and/or the global scope (ie. hostvars, group vars, etc.) should be mentioned here as well.

Dependencies
------------

A list of other roles hosted on Galaxy should go here, plus any details in regards to parameters that may need to be set for other roles, or variables that are used from other roles.

Example Playbook
-------------------------

Including an example of how to use your role (for instance, with variables passed in as parameters) is always nice for users too:

    - hosts: servers
      roles:
         - { role: username.rolename, x: 42 }

License
-------

GPLv3

Author Information
------------------

An optional section for the role authors to include contact information, or a website (HTML is not allowed).

References
----------

- [konomae/ansible-laravel-settler](https://github.com/konomae/ansible-laravel-settler)
- [laravel/homestead](https://github.com/laravel/homestead)
- [laravel/settler](https://github.com/laravel/settler)
