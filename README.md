TYPO3 Homestead
===============

TYPO3 Homestead is your one-stop [TYPO3](http://typo3.org) development environment. Just run `vagrant up` and a full Linux Ubuntu distribution will be built with all the packages and configuration needed to start development right away.

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
* TYPO3 CMS
* TYPO3 FLOW
* TYPO3 NEOS
* xdebug
* xhprof / blackfire
* zsh

The flexible configuration allows you to create any combination of TYPO3 source and PHP backend with or without SSL.

Requirements
------------

* [Virtualbox](https://www.virtualbox.org/) or another virtualization product
* [Vagrant](http://www.vagrantup.com/)
* [Ansible](http://www.ansible.com/)

You will need to install these roles before you can run the playbook.

```
ansible-galaxy install -r requirements.yml
```

Variables
--------------

A description of the settable variables for this role should go here, including any variables that are in defaults/main.yml, vars/main.yml, and any variables that can/should be set via parameters to the role. Any variables that are read from other roles and/or the global scope (ie. hostvars, group vars, etc.) should be mentioned here as well.

Dependencies
------------

TYPO3 Homestead uses several roles from the ansible-galaxy:
* [nbz4live.php-fpm](https://galaxy.ansible.com/list#/roles/304)
* [jdauphant.nginx](https://galaxy.ansible.com/list#/roles/466)
* [geerlingguy.composer](https://galaxy.ansible.com/list#/roles/429)
* [laggyluke.nodejs](https://galaxy.ansible.com/list#/roles/285)

You will need to install these roles before you can run the playbook.

```
ansible-galaxy install -r requirements.yml
```

Configuration Examples
----------------------

Setup your

    - hosts: servers
      roles:
         - { role: username.rolename, x: 42 }

License
-------

[GNU General Public License version 3](https://www.gnu.org/licenses/gpl-3.0.html)

References
----------

- [konomae/ansible-laravel-settler](https://github.com/konomae/ansible-laravel-settler)
- [laravel/homestead](https://github.com/laravel/homestead)
- [laravel/settler](https://github.com/laravel/settler)
