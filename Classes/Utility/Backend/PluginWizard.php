<?php

/**
 * Adds the Plugin Wizard to the Backend
 *
 * @author Noël Bossart
 */
class Tx_Nbowishlist_Utilities_PluginWizard {

	/**
	 * Adds the wizard icon
	 *
	 * @param	array		Input array with wizard items for plugins
	 * @return	array		Modified input array, having the item for the plugin added.
	 */
	function proc($wizardItems)	{
		$wizardItems['plugins_tx_nbowishlist_display'] = array(
			'icon'=>t3lib_extMgm::extRelPath('nbowishlist').'Resources/Public/Icons/be_wizard.gif',
			'title'=>Tx_Extbase_Utility_Localization::translate("backend.wizard", "nbowishlist", NULL),
			'description'=>Tx_Extbase_Utility_Localization::translate("backend.wizard.description", "nbowishlist", NULL),
			'params'=>'&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=nbowishlist_whishlist'
		);  
		return $wizardItems;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/nbowishlist/Classes/Utilities/Backend/wizicon.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/nbowishlist/Classes/Utilities/Backend/wizicon.php']);
}
?>