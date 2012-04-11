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

t3lib_extMgm::addLLrefForTCAdescr('tx_nbowishlist_domain_model_wish', 'EXT:nbowishlist/Resources/Private/Language/locallang_csh_tx_nbowishlist_domain_model_wish.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_nbowishlist_domain_model_wish');
$TCA['tx_nbowishlist_domain_model_wish'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:nbowishlist/Resources/Private/Language/locallang_db.xml:tx_nbowishlist_domain_model_wish',
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
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_nbowishlist_domain_model_wish.gif'
	),
);

t3lib_div::loadTCA("tx_nboevents_domain_model_person");
$tmp_nbowishlist_columns = array(
	'participations' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:nbowishlist/Resources/Private/Language/locallang_db.xml:tx_nbowishlist_domain_model_person.participations',
		'config' => array(
			'type' => 'inline',
			'foreign_table' => 'tx_nbowishlist_domain_model_participation',
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
t3lib_extMgm::addTCAcolumns("tx_nboevents_domain_model_person",$tmp_nbowishlist_columns,1);
t3lib_extMgm::addToAllTCAtypes('tx_nboevents_domain_model_person', 'participations','','after:reservations');

t3lib_extMgm::addLLrefForTCAdescr('tx_nbowishlist_domain_model_participation', 'EXT:nbowishlist/Resources/Private/Language/locallang_csh_tx_nbowishlist_domain_model_participation.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_nbowishlist_domain_model_participation');
$TCA['tx_nbowishlist_domain_model_participation'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:nbowishlist/Resources/Private/Language/locallang_db.xml:tx_nbowishlist_domain_model_participation',
		'label' => 'share',
		'label_userFunc' => 'EXT:nbowishlist/Classes/Domain/Model/Participation.php:Tx_Nbowishlist_Domain_Model_Participation->getLabel',
		
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
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_nbowishlist_domain_model_participation.gif'
	),
);


if (TYPO3_MODE == 'BE') {  
	// Add Wizard Icon
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['Tx_Nbowishlist_Utilities_PluginWizard'] = t3lib_extMgm::extPath($_EXTKEY).'Classes/Utility/Backend/PluginWizard.php';

	// Add tables on Pages:
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_nbowishlist_domain_model_wish'][0]['fList'] = 'title,price,images';
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_nbowishlist_domain_model_wish'][0]['icon'] = TRUE;
	
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_nbowishlist_domain_model_participation'][0]['fList'] = 'person,wish,share';
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_nbowishlist_domain_model_participation'][0]['icon'] = TRUE;
}
?>