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
class Tx_Nbowishlist_Domain_Model_Participation extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Share
	 *
	 * @var float
	 * @validate NotEmpty
	 */
	protected $share;

	/**
	 * Notes
	 *
	 * @var string
	 */
	protected $note;

	/**
	 * Person
	 *
	 * @var Tx_Nbowishlist_Domain_Model_Person
	 */
	protected $person;

	/**
	 * Wish
	 *
	 * @var Tx_Nbowishlist_Domain_Model_Wish
	 */
	protected $wish;

	/**
	 * Returns the share
	 *
	 * @return float $share
	 */
	public function getShare() {
		if(!$this->share){
			return 1;
		}
		return $this->share;
	}

	/**
	 * Sets the share
	 *
	 * @param float $share
	 * @return void
	 */
	public function setShare($share) {
		$this->share = $share;
	}

	/**
	 * Returns the note
	 *
	 * @return string $note
	 */
	public function getNote() {
		return $this->note;
	}

	/**
	 * Sets the note
	 *
	 * @param string $note
	 * @return void
	 */
	public function setNote($note) {
		$this->note = $note;
	}

	/**
	 * Returns the person
	 *
	 * @return Tx_Nbowishlist_Domain_Model_Person $person
	 */
	public function getPerson() {
		return $this->person;
	}

	/**
	 * Sets the person
	 *
	 * @param Tx_Nbowishlist_Domain_Model_Person $person
	 * @return void
	 */
	public function setPerson(Tx_Nbowishlist_Domain_Model_Person $person) {
		$this->person = $person;
	}

	/**
	 * Returns the wish
	 *
	 * @return Tx_Nbowishlist_Domain_Model_Wish $wish
	 */
	public function getWish() {
		return $this->wish;
	}

	/**
	 * Sets the wish
	 *
	 * @param Tx_Nbowishlist_Domain_Model_Wish $wish
	 * @return void
	 */
	public function setWish(Tx_Nbowishlist_Domain_Model_Wish $wish) {
		$this->wish = $wish;
	}
	
	
	/**
	 * Returns the Label for TCA
	 *
	 * @param array $params
	 * @return integer $remaining
	 */
	public function getLabel(&$return) {
		$uid = $return['row']['uid'];
		$repo = t3lib_div::makeInstance('Tx_Nbowishlist_Domain_Repository_ParticipationRepository');
		$return['title'] = $repo->findLabel($uid);
	}

}
?>