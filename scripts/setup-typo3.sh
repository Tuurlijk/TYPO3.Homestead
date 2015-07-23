#!/usr/bin/env bash

site=$1;

siteRoot="/var/www/${site}"

typo3ConfFolder="${siteRoot}/typo3conf"

mkdir -p "${typo3ConfFolder}"
touch "${typo3ConfFolder}/ENABLE_INSTALL_TOOL"