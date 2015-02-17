<?php

## INSTALL SCRIPT EDIT POINT TOKEN - all lines after this points may be changed by the install script!

$TYPO3_CONF_VARS['EXT']['extList'] = 'extbase,filelist,tsconfig_help,context_help,extra_page_cm_options,impexp,belog,about,cshmanual,aboutmodules,setup,opendocs,install,t3editor,felogin,feedit,recycler,info,perm,func,reports,scheduler,t3skin,fluid,smoothmigration,lowlevel';
$TYPO3_CONF_VARS['BE']['installToolPassword'] = 'bacb98acf97e0b6112b1d1b650b84971';
$TYPO3_CONF_VARS['GFX']['TTFdpi'] = 96;

$typo_db = '4_5_typo3_cms';
$typo_db_host = 'localhost';
$typo_db_username = 'typo3';
$typo_db_password = 'supersecret';

$TYPO3_CONF_VARS['SYS']['encryptionKey'] = 'abb93b1b58df54a8e3e812462c8a0d64a7fe21a612563dee87ebbc8a1510fae4afee6c06f575efbcce3f5062bddb2126';
$TYPO3_CONF_VARS['BE']['disable_exec_function'] = '0';
$TYPO3_CONF_VARS['GFX']['gdlib_png'] = '1';
$TYPO3_CONF_VARS['GFX']['im_version_5'] = 'gm';
$TYPO3_CONF_VARS['SYS']['setDBinit'] = '';
$TYPO3_CONF_VARS['BE']['forceCharset'] = '';
$TYPO3_CONF_VARS['SYS']['compat_version'] = '4.5';
$TYPO3_CONF_VARS['EXT']['extList_FE'] = 'extbase,install,felogin,feedit,t3skin,fluid,smoothmigration';
$TYPO3_CONF_VARS['INSTALL']['wizardDone']['tx_coreupdates_installsysexts'] = '1';
$TYPO3_CONF_VARS['INSTALL']['wizardDone']['tx_coreupdates_installnewsysexts'] = '1';

$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['cache_pages']['backend'] = 't3lib_cache_backend_MemcachedBackend';
$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['cache_pages']['options'] = array(
	'servers' => array('unix:///var/run/memcached/memcached.sock')
);
$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['cache_pagesection']['backend'] = 't3lib_cache_backend_MemcachedBackend';
$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['cache_pagesection']['options'] = array(
	'servers' => array('unix:///var/run/memcached/memcached.sock')
);
$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['cache_extbase_object']['backend'] = 't3lib_cache_backend_MemcachedBackend';
$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['cache_extbase_object']['options'] = array(
	'servers' => array('unix:///var/run/memcached/memcached.sock')
);
$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['cache_extbase_reflection']['backend'] = 't3lib_cache_backend_MemcachedBackend';
$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['cache_extbase_reflection']['options'] = array(
	'servers' => array('unix:///var/run/memcached/memcached.sock')
);
$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['cache_hash']['backend'] = 't3lib_cache_backend_MemcachedBackend';
$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['cache_hash']['options'] = array(
	'servers' => array('unix:///var/run/memcached/memcached.sock')
);
$TYPO3_CONF_VARS['SYS']['useCachingFramework'] = '1';
