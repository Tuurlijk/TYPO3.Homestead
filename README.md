TYPO3 Homestead
===============

*Update 26 august 2015:* Homestead now uses a pre-build box. It no longer requires ansible. All previous ansible functionality may be moved to inside the machine or replaced by bash scripts. If you would like to help out . . . patches are welcome ;-).

When I have a bit more time, I'll cook up some nice configuration that does away with the host system ansible requirement. It will be a light-weight version of the ansible setup found in this repository. It will run on the guest system with some clever trickery. Then we can use that to tweak config files, set up different php versions and TYPO3 versions. ETA: 2-3 months.

[![Flattr this git repo](http://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=Tuurlijk&url=https://github.com/Tuurlijk/TYPO3.Homestead&title=TYPO3.Homestead&language=Ansible&tags=github&category=software)

TYPO3 Homestead is your one-stop [TYPO3](http://typo3.org) development environment. Just run `vagrant up` and a full Linux Ubuntu distribution will be downloaded with all the packages and configuration needed to start development right away.

This environment is inteded as as a local environment. Security-wise it is in no way fit for production.

Effortlessly test one site against multiple PHP versions and hhvm.

Features
--------

TYPO3 Homestead comes with the following stack:

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
* TYPO3 CMS
* TYPO3 FLOW
* TYPO3 NEOS
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
When the installation process has finished, you can visit [http://local.typo3.org](http://local.typo3.org). And also any of the pre-configured sites or any site you configured. The default sites are:

* [6.2.cms.local.typo3.org/typo3/](http://6.2.cms.local.typo3.org/typo3/)
* [6.2.12.cms.local.typo3.org/typo3/](http://6.2.12.cms.local.typo3.org/typo3/)
* [7.4.cms.local.typo3.org/typo3/](http://7.1.cms.local.typo3.org/typo3/)
* [dev-master.cms.local.typo3.org/typo3/](http://dev-master.cms.local.typo3.org/typo3/)
* [1.2.neos.local.typo3.org/neos/](http://1.2.neos.local.typo3.org/neos/)
* [dev-master.neos.local.typo3.org/neos/](http://dev-master.neos.local.typo3.org/neos/)

All TYPO3 and Neos installation are fully set-up. You can login to the backend with: `admin`/`supersecret`.

The error log can be inspected using: `multitail /var/log/nginx/error.log`.

The database credentials can be found in `roles/mariadb/vars/main.yml`. The typo3 user has access to all databases. The install tool password is the TYPO3 default.

The amount of cpu's avaialble on the host machine will also be available on the guest machine. 25% of the available host machine memory will be made available on the guest machine. The minimum amount of memory will be envforced to 1024 MB. You should not have to pass any extra parameters when starting the box.

The CNAME *.local.typo3.org resolves to the IP 192.168.144.120. This means you will have magic auto-resolving hostnames. So if you change the IP, you will need to take care of your hostname resolving yourself, either by hardcoding all the hostnames you wish to use or by some other means.

TYPO3 installations
-------------------

You can override any of the role variables in the configuration files in the `/Configuration/` directory. The options have been tuned for usage with TYPO3, so the ones you will most likely be changing are the `typo3.yml` and the `websites.yml` files. In the `typo3.yml` file you can configure your typo3.org username and what TYPO3 versions you wish to have available.

The site *key* will be the domain name under which you can access the site. The site *value* is the TYPO3 version that will be checked out for that site. For TYPO3 4.x sites, you can specify a git branch or tag to checkout. For TYPO3 versions from 6.2.6 and up, we use [TYPO3 console](https://github.com/helhum/typo3_console) to install TYPO3. This means you can use [composer](https://getcomposer.org/) notation to specify a TYPO3 tag.

```yaml
typo3:
  cms:
    sites:
      4.5.cms.local.typo3.org: 'TYPO3_4-5'
      4.5.40.cms.local.typo3.org: 'TYPO3_4-5-40'
      6.2.cms.local.typo3.org: '6.2.*'
      6.2.12.cms.local.typo3.org: '6.2.12'
      7.1.0.cms.local.typo3.org: '7.1.0'
      dev-master.cms.local.typo3.org: '*'
```

TYPO3 Homestead uses *wilcard* server names in the Nxinx configuration. So you don't have to manually add any site configuration (except if you want to test ssl). The request url will determine the document root. The regular site requests will use the default php-fpm backend. The other backends currently available are: *hhvm* and *xhprof*. Xhprof will need further pool configuration though.

If you prefix your site name with 'hhvm' for example, your request will be served by the hhvm backend:

* [http://php.6.2.12.cms.local.typo3.org/typo3/](http://php.6.2.12.cms.local.typo3.org/typo3/)
* [http://hhvm.6.2.12.cms.local.typo3.org/typo3/](http://hhvm.6.2.12.cms.local.typo3.org/typo3/)

You can see what backend is used by inspecting the `X-TYPO3-Homestead-backend` response header.

You can now 'launch' a new test site just by placing a new folder in your Development directory. If you link to the TYPO3 source yourself, you don't even need a mapping configuration in the typo3.yml file. Your site will be instantly available (if the folder name matches one of the wildcard regexes).

If you change any typo3 configuration (Add new tags / branches) after you have provisioned your server, you will need to re-provision using:

```bash
ANSIBLE_ARGS='--tags=typo3,nginx' vagrant provision
```

Please note that typo3 needs to run first because the ssl certificates and web directories need to be available for nginx to pass the configuration check. If you change only nginx configuration after you have provisioned your server, you can re-provision using:

```bash
ANSIBLE_ARGS='--tags=nginx' vagrant provision
```

Need to enable an install tool? The following command will create the **ENABLE_INSTALL_TOOL** files in all TYPO3 CMS instances:

```bash
ANSIBLE_ARGS='--tags=typo3-cms-installtool' vagrant provision
```

The NEOS sites are fully functional out of the box. The TYPO3.NeosDemoTypo3Org Site is already running. The TYPO3 CMS configuration sets up an empty database and an empty site. You can log into the backend, but you will still need to install the introduction package using the extension manager.

You can enable and disable extensions by specifying them in the TYPO3 configuration under the key: `typo3.cms.extensions.enabled` and `typo3.cms.extensions.disabled`:

```yaml
typo3:
  cms:
    sites:
      6.2.cms.local.typo3.org: '6.2.*'
      6.2.12.cms.local.typo3.org: '6.2.12'
      7.1.cms.local.typo3.org: '7.1.*'
      dev-master.cms.local.typo3.org: '*'
    extensions:
      disabled:
        - taskcenter
      enabled:
        - scheduler
        - opendocs
```

Multiple PHP versions
---------------------

If you want to test against multiple PHP versions, you can enable phpbrew and build any of the available PHP versions. You can see the available versions by executing:

```bash
phpbrew known
```

To test against the latest versions of the major branches, you can add the following configuration snippet to your `Configuration/php.yml` file:

```yaml
php_brew_enable: yes
php_brew_versions: ['5.3.29', '5.4.38', '5.5.22', '5.6.6']
```
To build the versions and activate the sockets, you must run:

```bash
ANSIBLE_ARGS='--tags=php-brew' vagrant provision
```

If you prefix your site name with 'php5_3_29', 'php5_4_38', 'php5_5_22' or 'php5_6_6', your request will be served by that backend:

* [http://php5_3_29.6.2.12.cms.local.typo3.org/typo3/](http://php5_3_29.6.2.12.cms.local.typo3.org/typo3/)
* [http://php5_6_6.6.2.12.cms.local.typo3.org/typo3/](http://php5_6_6.6.2.12.cms.local.typo3.org/typo3/)

You can see what backend is used by inspecting the `X-TYPO3-Homestead-backend` response header.

Please note that each php socket must be made available to nginx by changing the `nginx_configs` variable. The default value (found in `Defaults/nginx.yml`) contains:

```yaml
nginx_configs:
  upstream_hhvm:
    - upstream hhvm { server unix:/var/run/hhvm/sock; }
  upstream_php:
    - upstream php { server unix:/var/run/php5-fpm.sock; }
  upstream_php5_3_29:
    - upstream php5_3_29 { server unix:/var/run/php-fpm.5.3.29.default.sock; }
  upstream_php5_4_38:
    - upstream php5_4_38 { server unix:/var/run/php-fpm.5.4.38.default.sock; }
  upstream_php5_5_22:
    - upstream php5_5_22 { server unix:/var/run/php-fpm.5.5.22.default.sock; }
  upstream_php5_6_6:
    - upstream php5_6_6 { server unix:/var/run/php-fpm.5.6.6.default.sock; }
  upstream_xhprof:
    - upstream xhprof { server unix:/var/run/php5-fpm.xhprof.sock; }
```

I you wish to add your own php versions, please adjust this variable accordingly in your `Configuration/nginx.yml`.

Learn more about phpbrew on [the phpbrew project page](https://github.com/phpbrew/phpbrew).

MailCatcher
-----------

[MailCatcher](http://mailcatcher.me/) runs a super simple SMTP server which catches any message sent to it to display in a web interface. This makes it easy to test forms without actually sending mail to the 'real' mail address. Set your favourite app to deliver to smtp://127.0.0.1:1025 instead of your default SMTP server, then check out [http://homestead.local.typo3.org:1080](http://homestead.local.typo3.org:1080) to see the mail that's arrived so far.

To disable this feature, add the following to your `Configuration/main.yml`:

```yaml
mailcatcher_enable: no
```

Mailcatcher has been set up for TYPO3 CMS. For Neos, you may be interested in the [https://github.com/langeland/Langeland.SwiftBox](Langeland.SwiftBox) package. It is a package that can override the swiftmailer setting to send to that instead and you can browse all the emails with the included flow application.

Configuration Examples
----------------------

You can choose between different PHP upstream backends:
* php: php-fpm
* xhprof: php-fpm-xhprof (not enabled yet: wip)
* hhvm: hhvm

```yaml
nginx_sites:
  default:
    - set $upstream hhvm
    - listen 80 default_server
    - server_name _
    - root "{{ typo3_webroot }}/homestead.local.typo3.org/"
    - "{{ nginx_fastcgi }}"
  default-ssl:
    - set $upstream php
    - listen 443 default_server
    - server_name _
    - root "{{ typo3_webroot }}/homestead.local.typo3.org/"
    - "{{ nginx_fastcgi }}"
    - ssl on
    - ssl_certificate /etc/ssl/certs/homestead.local.typo3.org.crt
    - ssl_certificate_key /etc/ssl/private/homestead.local.typo3.org.key
  typo3.cms:
    - set $upstream php
    - server_name ~(?<serverNameUpstream>xhprof|blackfire|hhvm|php\d\d?_\d\d?_\d\d?|php)?\.?(?<version>.*)\.cms.local.typo3.org$
    - if ($serverNameUpstream ~ (php|xhprof|blackfire|hhvm|php\d\d?_\d\d?_\d\d?|php)) { set $upstream $serverNameUpstream; }
    - root "{{ typo3_webroot }}${version}.cms.local.typo3.org/";
    - "{{ nginx_fastcgi }}"
```

Please take care to add a domain-name to source mapping in the typo3.yml for each site you configure. Unless you manually set up your sites in your shared folder and link to the available sources yourself.

The `typo3_ssl_certificates` variable is an array of domain names for which self signed ssl certificates will be generated. A wildcard certificates will be generated for *.local.typo3.org.

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
