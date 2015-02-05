<?php

## INSTALL SCRIPT EDIT POINT TOKEN - all lines after this points may be changed by the install script!

$TYPO3_CONF_VARS['EXT']['extList'] = 'extbase,filelist,tsconfig_help,context_help,extra_page_cm_options,impexp,belog,about,cshmanual,aboutmodules,setup,opendocs,install,t3editor,felogin,feedit,recycler,adodb,info,perm,func,reports,scheduler,t3skin,fluid';
$TYPO3_CONF_VARS['BE']['installToolPassword'] = 'bacb98acf97e0b6112b1d1b650b84971';
$TYPO3_CONF_VARS['GFX']['TTFdpi'] = 96;

$typo_db = '4_5_typo3_cms';
$typo_db_host = 'localhost';
$typo_db_username = 'typo3';
$typo_db_password = 'supersecret';

$TYPO3_CONF_VARS['SYS']['encryptionKey'] = '435a3a67c8669a2b6f5b352af308556cee177e6a77a39b89dec2779eebd3053898b4844ccf67897fd7d7a8d60c777a3c';
$TYPO3_CONF_VARS['BE']['disable_exec_function'] = '0';
$TYPO3_CONF_VARS['GFX']['gdlib_png'] = '1';
$TYPO3_CONF_VARS['GFX']['im_version_5'] = 'gm';
$TYPO3_CONF_VARS['SYS']['setDBinit'] = '';
$TYPO3_CONF_VARS['BE']['forceCharset'] = '';
$TYPO3_CONF_VARS['SYS']['compat_version'] = '4.5';
$TYPO3_CONF_VARS['EXT']['extList_FE'] = 'extbase,install,felogin,feedit,adodb,t3skin,fluid'; 
$TYPO3_CONF_VARS['INSTALL']['wizardDone']['tx_coreupdates_installsysexts'] = '1';
$TYPO3_CONF_VARS['INSTALL']['wizardDone']['tx_coreupdates_installnewsysexts'] = '1';
