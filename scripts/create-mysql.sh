#!/usr/bin/env bash

DB=$1;
DB="${DB//./_}"

mysql -uroot -psupersecret -e "DROP DATABASE IF EXISTS \`$DB\`";
mysql -uroot -psupersecret -e "CREATE DATABASE \`$DB\` DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_unicode_ci";
mysql -uroot -psupersecret -e "GRANT ALL PRIVILEGES ON \`$DB\`.* TO typo3 identified by 'supersecret'";
