<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Whishlist',
	'Whishlists'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Wish List');

t3lib_extMgm::addLLrefForTCAdescr('tx_sjwishlist_domain_model_wish', 'EXT:sjwishlist/Resources/Private/Language/locallang_csh_tx_sjwishlist_domain_model_wish.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_sjwishlist_domain_model_wish');
$TCA['tx_sjwishlist_domain_model_wish'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:sjwishlist/Resources/Private/Language/locallang_db.xml:tx_sjwishlist_domain_model_wish',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Wish.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_sjwishlist_domain_model_wish.gif'
	),
);

t3lib_div::loadTCA("tx_sjevents_domain_model_person");
$tmp_sjwishlist_columns = array(
	'participations' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:sjwishlist/Resources/Private/Language/locallang_db.xml:tx_sjwishlist_domain_model_person.participations',
		'config' => array(
			'type' => 'inline',
			'foreign_table' => 'tx_sjwishlist_domain_model_participation',
			'foreign_field' => 'person',
			'maxitems'      => 9999,
			'appearance' => array(
				'collapse' => 0,
				'levelLinksPosition' => 'top',
				'showSynchronizationLink' => 1,
				'showPossibleLocalizationRecords' => 1,
				'showAllLocalizationLink' => 1
			),
		),
	),
);
t3lib_extMgm::addTCAcolumns("tx_sjevents_domain_model_person",$tmp_sjwishlist_columns,1);
t3lib_extMgm::addToAllTCAtypes('tx_sjevents_domain_model_person', 'participations','','after:reservations');

t3lib_extMgm::addLLrefForTCAdescr('tx_sjwishlist_domain_model_participation', 'EXT:sjwishlist/Resources/Private/Language/locallang_csh_tx_sjwishlist_domain_model_participation.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_sjwishlist_domain_model_participation');
$TCA['tx_sjwishlist_domain_model_participation'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:sjwishlist/Resources/Private/Language/locallang_db.xml:tx_sjwishlist_domain_model_participation',
		'label' => 'share',
		'label_userFunc' => 'EXT:sjwishlist/Classes/Domain/Model/Participation.php:Tx_Sjwishlist_Domain_Model_Participation->getLabel',
		
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Participation.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_sjwishlist_domain_model_participation.gif'
	),
);

?>