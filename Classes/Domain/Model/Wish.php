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
class Tx_Nbowishlist_Domain_Model_Wish extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * Description
	 *
	 * @var string
	 */
	protected $description;

	/**
	 * Price
	 *
	 * @var float
	 */
	protected $price;

	/**
	 * Maximum Reservations
	 *
	 * @var float
	 */
	protected $minshare;

	/**
	 * Notes for Reservations
	 *
	 * @var string
	 */
	protected $notes;

	/**
	 * Images
	 *
	 * @var string
	 */
	protected $images;

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
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}
	
	

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the price
	 *
	 * @return float $price
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * Sets the price
	 *
	 * @param float $price
	 * @return void
	 */
	public function setPrice($price) {
		$this->price = $price;
	}

	/**
	 * Returns the minshare
	 *
	 * @return float $minshare
	 */
	public function getMinshare() {
		return $this->minshare;
	}
	
	/**
	 * Returns the minshare in percent
	 *
	 * @return float $minsharePercent
	 */
	public function getMinsharePercent() {
		return $this->minshare / ($this->price / 100);
	}

	/**
	 * Sets the minshare
	 *
	 * @param float $minshare
	 * @return void
	 */
	public function setMinshare($minshare) {
		$this->minshare = $minshare;
	}

	/**
	 * Returns the notes
	 *
	 * @return string $notes
	 */
	public function getNotes() {
		return $this->notes;
	}

	/**
	 * Sets the notes
	 *
	 * @param string $notes
	 * @return void
	 */
	public function setNotes($notes) {
		$this->notes = $notes;
	}

	/**
	 * Returns the images
	 *
	 * @return string $images
	 */
	public function getImages() {
		return explode(",",$this->images);
	}

	/**
	 * Sets the images
	 *
	 * @param string $images
	 * @return void
	 */
	public function setImages($images) {
		$this->images = $images;
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
	
	/**
	 * Get Payment Status
	 *
	 */
	public function getStatus() {
		$repo = t3lib_div::makeInstance('Tx_Nbowishlist_Domain_Repository_ParticipationRepository');
		$status = $repo->sharesByWish($this->getUid());
		return $status;
	}
	
	
	/**
	 * Get Remaining Amount
	 *
	 */
	public function getRemaining() {
		return $this->getPrice() - $this->getStatus() + $this->getMinshare();
	}
	
	/**
	 * Get Payment Status
	 *
	 */
	public function getStatusPercent() {
		$status = $this->getStatus();
		$price = $this->getPrice();
		if($price > 0){
			$payed = $status / $price * 100;
		} else if ($status) {
			$payed = 100;
		}
		return $payed;
	}
	
	/**
	 * Get Payment Status
	 *
	 */
	public function getStatusMinPercent() {
		$status = $this->getStatusPercent();
		if($status < 3){
			return 3;
		}
		if($status > 100){
			return 100;
		}
		return $status;
	}
	
	/**
	 * Get Shares
	 *
	 * @return float shares
	 */
	public function getShares() {
		$repo = t3lib_div::makeInstance('Tx_Nbowishlist_Domain_Repository_ParticipationRepository');
		return $repo->sharesByWish($this->getUid());
	}
	
	/**
	 * Get remaining Shares
	 *
	 * @return float remaining shares
	 */
	public function getSharesRemaining() {
		return $this->getPrice() - $this->getShares();
	}
	
	/**
	 * Wish has Reservation
	 *
	 * @return boolean shares
	 */
	public function getHasShares() {
		$has = false;
		if($this->getShares()){
			$has =  true;
		}
		return $has;
	}
}
?>