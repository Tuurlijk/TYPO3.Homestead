TYPO3 Homestead
===============

*Update 26 august 2015:* Homestead now uses a pre-built box. It no longer requires ansible. All previous ansible functionality may be moved to inside the machine or replaced by bash scripts. If you would like to help out . . . [patches are welcome ;-)](https://github.com/Tuurlijk/TYPO3.Packer).

When I have a bit more time, I'll cook up some nice configuration that does away with the host system ansible requirement. It will be a light-weight version of the ansible setup found in this repository. It will run on the guest system with some clever trickery. Then we can use that to tweak config files, set up different php versions and TYPO3 versions. ETA: 2-3 months.

[![Flattr this git repo](http://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=Tuurlijk&url=https://github.com/Tuurlijk/TYPO3.Homestead&title=TYPO3.Homestead&language=Ansible&tags=github&category=software)

TYPO3 Homestead is your one-stop [TYPO3](http://typo3.org) and [Neos](http://neos.io) development environment. Just run `vagrant up` and a full Linux Ubuntu distribution will be downloaded with all the packages and configuration needed to start development right away.

This environment is inteded as as a local environment. Security-wise it is in no way fit for production.

Effortlessly test one site against multiple PHP versions and hhvm.

Features
--------

TYPO3 Homestead comes with the following stack:

* TYPO3 CMS
* NEOS CMS
* composer
* hhvm
* multiple PHP versions
* mailcatcher
* mariadb
* memcached
* nginx
* nodejs
* php-apcu
* php-fpm
* postfix nullmailer (outgoing only)
* self signed ssl certificates
* xdebug
* xhprof / blackfire
* zsh

The flexible configuration allows you to create any combination of TYPO3 source and PHP backend with or without SSL.

Requirements
------------

* [Virtualbox](https://www.virtualbox.org/) or another virtualization product - Free!
* [Vagrant](http://www.vagrantup.com/) - Version 1.5.* is needed - Free!

Installation
------------

Installation is pretty straight forward. You're just a few steps away from 'great success'.

1). Clone TYPO3.Homestead and cd into it:
```bash
git clone https://github.com/Tuurlijk/TYPO3.Homestead.git
cd TYPO3.Homestead
```

2). Copy any configuration files you wish to change from `Defaults/` to `Configuration/`. Optionally setup a shared directory to hold your TYPO3 sources and sites in the `Configuration/vagrant.yml` file:

```yaml
synced_folders:
  - name: Development
    src: ~/Projects/TYPO3/Development
    target: /var/www
```

If you don't do this, you may want to add your public ssh key to the authorized_keys file of the vagrant user. Read the section SSH Access below.

3). Then boot the machine:
```bash
vagrant up
```
When the machine has booted, you can visit [http://local.typo3.org](http://local.typo3.org). And also any of the pre-configured sites or any site you configured. The default sites are:

* [6.2.local.typo3.org/typo3/](http://6.2.local.typo3.org/typo3/)
* [7.5.local.typo3.org/typo3/](http://7.5.local.typo3.org/typo3/)
* [dev-master.local.typo3.org/typo3/](http://dev-master.local.typo3.org/typo3/)
* [1.2.local.neos.io/neos/](http://1.2.local.neos.io/neos/)
* [2.0.local.neos.io/neos/](http://2.0.local.neos.io/neos/)
* [dev-master.local.neos.io/typo3/](http://dev-master.local.neos.io/typo3/)

All TYPO3 and Neos installation are fully set-up. You can login to the backend with: `admin`/`supersecret`.

The error log can be inspected using: `multitail /var/log/nginx/error.log`.

The database credentials can be found in `roles/mariadb/vars/main.yml`. The typo3 user has access to all databases. The install tool password is the TYPO3 default.

The amount of cpu's avaialble on the host machine will also be available on the guest machine. 25% of the available host machine memory will be made available on the guest machine. The minimum amount of memory will be envforced to 1024 MB. You should not have to pass any extra parameters when starting the box.

The CNAME *.local.typo3.org resolves to the IP 192.168.144.120. This means you will have magic auto-resolving hostnames. So if you change the IP, you will need to take care of your hostname resolving yourself, either by hardcoding all the hostnames you wish to use or by some other means.

SSH Access
----------

If you set up a box without a file share, you will want to access the box using ssh. To add your public ssh key to the authorized_keys file of the vagrant user, you can execute the following command:

```bash
 cat ~/.ssh/id_rsa.pub | ssh vagrant@local.typo3.org 'cat >> .ssh/authorized_keys'
```

Now you will be able to get into the box as user vagrant without supplying a password.

Multiple PHP versions
---------------------

If you prefix your site name with `hhvm`,  `php5_5_28` or `php5_6_12`, your request will be served by that backend:

You can see what backend is used by inspecting the `X-Powered-By` response header.

MailCatcher
-----------

[MailCatcher](http://mailcatcher.me/) runs a super simple SMTP server which catches any message sent to it to display in a web interface. This makes it easy to test forms without actually sending mail to the 'real' mail address. Set your favourite app to deliver to smtp://127.0.0.1:1025 instead of your default SMTP server, then check out [http://local.typo3.org:1080](http://local.typo3.org:1080) to see the mail that's arrived so far.

Mailcatcher has been set up for TYPO3 CMS. For Neos, you may be interested in the [https://github.com/langeland/Langeland.SwiftBox](Langeland.SwiftBox) package. It is a package that can override the swiftmailer setting to send to that instead and you can browse all the emails with the included flow application.

Can't connect after the vagrant up?
-----------------------------------

This box needs internet connectivity to resolve the local.neos.io domain name to the IP of the box. If you are not connected to the Internet you will need to add the following entries to your hosts file:

* 192.168.144.120 1.2.local.neos.io
* 192.168.144.120 2.0.local.neos.io
* 192.168.144.120 dev-master.local.neos.io
* 192.168.144.120 6.2.local.typo3.org
* 192.168.144.120 7.5.local.typo3.org
* 192.168.144.120 dev-master.local.typo3.org

Contributing
------------

In lieu of a formal styleguide, take care to maintain the existing coding style. Add unit tests and examples for any new or changed functionality.

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request

TODO
----

* Nginx configuration snippets?
  https://github.com/h5bp/server-configs-nginx/blob/master/h5bp/
* Enable configuration through yml file like http://laravel.com/docs/5.0/homestead
* Add available backends as examples to index sites (http://local.neos.io and http://local.typo3.org)

Known Problems
--------------

* The sources that are fetched from github may be hard to reach when github is under a DDOS
* If you get the error `The box 'ubuntu/trusty64' could not be found`, then you may have a vagrant version lower than 1.5. The stock Ubuntu vagrant version is 1.4 at the time of writing. You can get the latest vagrant version from [the vagrant site](https://www.vagrantup.com/downloads). Some details can be found on [vaprobash issue #322](https://github.com/fideloper/Vaprobash/issues/322).

License
-------

[GNU General Public License version 3](https://www.gnu.org/licenses/gpl-3.0.html)

References
----------

- [konomae/ansible-laravel-settler](https://github.com/konomae/ansible-laravel-settler)
- [laravel/homestead](https://github.com/laravel/homestead)
- [laravel/settler](https://github.com/laravel/settler)
- [phpbrew](https://github.com/phpbrew/phpbrew)
