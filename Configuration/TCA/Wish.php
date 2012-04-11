<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_nbowishlist_domain_model_wish'] = array(
	'ctrl' => $TCA['tx_nbowishlist_domain_model_wish']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, description, price, minshare, notes, images, participations',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, description, price, minshare, notes, images, participations,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_nbowishlist_domain_model_wish',
				'foreign_table_where' => 'AND tx_nbowishlist_domain_model_wish.pid=###CURRENT_PID### AND tx_nbowishlist_domain_model_wish.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nbowishlist/Resources/Private/Language/locallang_db.xml:tx_nbowishlist_domain_model_wish.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nbowishlist/Resources/Private/Language/locallang_db.xml:tx_nbowishlist_domain_model_wish.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'price' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nbowishlist/Resources/Private/Language/locallang_db.xml:tx_nbowishlist_domain_model_wish.price',
			'config' => array(
				'type' => 'input',
				'size' => 6,
				'eval' => 'double2'
			),
		),
		'minshare' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nbowishlist/Resources/Private/Language/locallang_db.xml:tx_nbowishlist_domain_model_wish.minshare',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'double2'
			),
		),
		'notes' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nbowishlist/Resources/Private/Language/locallang_db.xml:tx_nbowishlist_domain_model_wish.notes',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'images' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nbowishlist/Resources/Private/Language/locallang_db.xml:tx_nbowishlist_domain_model_wish.images',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'uploadfolder' => 'uploads/tx_nbowishlist',
				'minitems' => 0,
				'maxitems' => 10,
				'disable_controls' => 'upload',
				'size' => 5,
				'show_thumbs' => 1,
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'disallowed' => '',
			),
		),
		'participations' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nbowishlist/Resources/Private/Language/locallang_db.xml:tx_nbowishlist_domain_model_wish.participations',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_nbowishlist_domain_model_participation',
				'foreign_field' => 'wish',
				// manually added
				'foreign_label' => 'person',
				'maxitems' => 9999,
				'appearance' => array(
					'collapse' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
	),
);

?>