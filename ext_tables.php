<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Subscribe',
	'Subscribe to Newsletter'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Unsubscribe',
	'Unsubscribe from Newsletter'
);
//
//if (TYPO3_MODE === 'BE') {
//
//	/**
//	 * Registers a Backend Module
//	 */
//	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
//		'FI.' . $_EXTKEY,
//		'web',	 // Make module a submodule of 'web'
//		'management',	// Submodule key
//		'',						// Position
//		array(
//			'Recipient' => 'new, create, edit, update',
//		),
//		array(
//			'access' => 'user,group',
//			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
//			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_management.xlf',
//		)
//	);
//
//}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Newsletter');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_finewsletter_domain_model_recipient', 'EXT:finewsletter/Resources/Private/Language/locallang_csh_tx_finewsletter_domain_model_recipient.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_finewsletter_domain_model_recipient');
$GLOBALS['TCA']['tx_finewsletter_domain_model_recipient'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:finewsletter/Resources/Private/Language/locallang_db.xlf:tx_finewsletter_domain_model_recipient',
		'label' => 'email',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'email,token,active,useragent,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Recipient.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_finewsletter_domain_model_recipient.gif'
	),
);