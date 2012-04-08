<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Whishlist',
	array(
		'Wish' => 'list, show',
		//'Person' => 'list, show, new, create, edit, update, delete',
		'Participation' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		//'Wish' => 'create, update, delete',
		//'Person' => 'create, update, delete',
		'Participation' => 'list, show, new, create, edit, update, delete',
	)
);

?>