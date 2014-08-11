<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'FI.' . $_EXTKEY,
	'Subscribe',
	array(
		'Recipient' => 'subscribe, create, verify',
		
	),
	// non-cacheable actions
	array(
		'Recipient' => 'subscribe, create, verify',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'FI.' . $_EXTKEY,
	'Unsubscribe',
	array(
		'Recipient' => 'unsubscribe, update',
		
	),
	// non-cacheable actions
	array(
		'Recipient' => 'unsubscribe, update',
		
	)
);