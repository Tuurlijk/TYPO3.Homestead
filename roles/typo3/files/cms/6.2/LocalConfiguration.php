<?php
return array(
	'BE' => array(
		'debug' => TRUE,
		'explicitADmode' => 'explicitAllow',
		'installToolPassword' => '$P$CiegnFvFqP68E3QcshI4QCUmaCoLu71',
		'loginSecurityLevel' => 'rsa',
	),
	'DB' => array(
		'database' => '6_2_typo3_cms',
		'extTablesDefinitionScript' => 'extTables.php',
		'host' => 'localhost',
		'password' => 'supersecret',
		'socket' => '',
		'username' => 'typo3',
	),
	'EXT' => array(
		'extConf' => array(
			'bootstrap_package' => 'a:10:{s:16:"disablePageTsRTE";s:1:"0";s:20:"disablePageTsTCEFORM";s:1:"0";s:20:"disablePageTsTCEMAIN";s:1:"0";s:21:"disablePageTsAdmPanel";s:1:"0";s:27:"disablePageTsBackendLayouts";s:1:"0";s:16:"UseRealUrlConfig";s:1:"1";s:18:"disableBackendSkin";s:1:"0";s:4:"Logo";s:84:"../typo3conf/ext/bootstrap_package/Resources/Public/Images/Backend/TopBarLogo@2x.png";s:9:"LoginLogo";s:80:"../typo3conf/ext/bootstrap_package/Resources/Public/Images/Backend/LoginLogo.png";s:21:"checkIfThemesIsLoaded";s:1:"0";}',
			'introduction' => 'a:0:{}',
			'realurl' => 'a:5:{s:10:"configFile";s:26:"typo3conf/realurl_conf.php";s:14:"enableAutoConf";s:1:"1";s:14:"autoConfFormat";s:1:"0";s:12:"enableDevLog";s:1:"0";s:19:"enableChashUrlDebug";s:1:"0";}',
			'rsaauth' => 'a:1:{s:18:"temporaryDirectory";s:0:"";}',
			'saltedpasswords' => 'a:2:{s:3:"BE.";a:4:{s:21:"saltedPWHashingMethod";s:41:"TYPO3\\CMS\\Saltedpasswords\\Salt\\PhpassSalt";s:11:"forceSalted";i:0;s:15:"onlyAuthService";i:0;s:12:"updatePasswd";i:1;}s:3:"FE.";a:5:{s:7:"enabled";i:1;s:21:"saltedPWHashingMethod";s:41:"TYPO3\\CMS\\Saltedpasswords\\Salt\\PhpassSalt";s:11:"forceSalted";i:0;s:15:"onlyAuthService";i:0;s:12:"updatePasswd";i:1;}}',
		),
	),
	'FE' => array(
		'activateContentAdapter' => FALSE,
		'debug' => TRUE,
		'loginSecurityLevel' => 'rsa',
	),
	'GFX' => array(
		'colorspace' => 'RGB',
		'im' => 1,
		'im_mask_temp_ext_gif' => 1,
		'im_path' => '/usr/bin/',
		'im_path_lzw' => '/usr/bin/',
		'im_v5effects' => -1,
		'im_version_5' => 'gm',
		'image_processing' => 1,
		'jpg_quality' => '80',
	),
	'SYS' => array(
		'caching' => array(
			'cacheConfigurations' => array(
				'extbase_object' => array(
					'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\ApcBackend',
					'frontend' => 'TYPO3\\CMS\\Core\\Cache\\Frontend\\VariableFrontend',
					'groups' => array(
						'system',
					),
					'options' => array(
						'defaultLifetime' => 0,
					),
				),
			),
		),
		'clearCacheSystem' => TRUE,
		'compat_version' => '6.2',
		'devIPmask' => '*',
		'displayErrors' => 1,
		'enableDeprecationLog' => 'file',
		'encryptionKey' => '63b46cd2dc48dee2552d41108cd9744a0e00fbb0e1c94d30becc2c36c7f67ba634a81915b4faf64f7ccbb342a079f3dd',
		'exceptionalErrors' => 28674,
		'isInitialInstallationInProgress' => FALSE,
		'sitename' => 'New TYPO3 site',
		'sqlDebug' => 1,
		'systemLogLevel' => 0,
		't3lib_cs_convMethod' => 'mbstring',
		't3lib_cs_utils' => 'mbstring',
	),
);
?>