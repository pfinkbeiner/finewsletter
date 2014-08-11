<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'FI.' . $_EXTKEY,
	'Subscribe',
	array(
		'Recipient' => 'new, create, edit, update',
		
	),
	// non-cacheable actions
	array(
		'Recipient' => 'create, update',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'FI.' . $_EXTKEY,
	'Unsubscribe',
	array(
		'Recipient' => 'new, create, edit, update',
		
	),
	// non-cacheable actions
	array(
		'Recipient' => 'create, update',
		
	)
);
