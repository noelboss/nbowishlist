<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Noel Bossart <n.company@me.com>
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package nbowishlist
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_Nbowishlist_Domain_Model_Person extends Tx_Nboevents_Domain_Model_Person {

	/**
	 * Participations
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Nbowishlist_Domain_Model_Participation>
	 */
	protected $participations;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->participations = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Adds a Participation
	 *
	 * @param Tx_Nbowishlist_Domain_Model_Participation $participation
	 * @return void
	 */
	public function addParticipation(Tx_Nbowishlist_Domain_Model_Participation $participation) {
		$this->participations->attach($participation);
	}

	/**
	 * Removes a Participation
	 *
	 * @param Tx_Nbowishlist_Domain_Model_Participation $participationToRemove The Participation to be removed
	 * @return void
	 */
	public function removeParticipation(Tx_Nbowishlist_Domain_Model_Participation $participationToRemove) {
		$this->participations->detach($participationToRemove);
	}

	/**
	 * Returns the participations
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Nbowishlist_Domain_Model_Participation> $participations
	 */
	public function getParticipations() {
		return $this->participations;
	}

	/**
	 * Sets the participations
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Nbowishlist_Domain_Model_Participation> $participations
	 * @return void
	 */
	public function setParticipations(Tx_Extbase_Persistence_ObjectStorage $participations) {
		$this->participations = $participations;
	}

}
?>