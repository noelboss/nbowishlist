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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Tx_Sjwishlist_Domain_Model_Person.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Wish List
 *
 * @author Noel Bossart <n.company@me.com>
 */
class Tx_Sjwishlist_Domain_Model_PersonTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Sjwishlist_Domain_Model_Person
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Sjwishlist_Domain_Model_Person();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getParticipationsReturnsInitialValueForObjectStorageContainingTx_Sjwishlist_Domain_Model_Participation() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getParticipations()
		);
	}

	/**
	 * @test
	 */
	public function setParticipationsForObjectStorageContainingTx_Sjwishlist_Domain_Model_ParticipationSetsParticipations() { 
		$participation = new Tx_Sjwishlist_Domain_Model_Participation();
		$objectStorageHoldingExactlyOneParticipations = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneParticipations->attach($participation);
		$this->fixture->setParticipations($objectStorageHoldingExactlyOneParticipations);

		$this->assertSame(
			$objectStorageHoldingExactlyOneParticipations,
			$this->fixture->getParticipations()
		);
	}
	
	/**
	 * @test
	 */
	public function addParticipationToObjectStorageHoldingParticipations() {
		$participation = new Tx_Sjwishlist_Domain_Model_Participation();
		$objectStorageHoldingExactlyOneParticipation = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneParticipation->attach($participation);
		$this->fixture->addParticipation($participation);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneParticipation,
			$this->fixture->getParticipations()
		);
	}

	/**
	 * @test
	 */
	public function removeParticipationFromObjectStorageHoldingParticipations() {
		$participation = new Tx_Sjwishlist_Domain_Model_Participation();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($participation);
		$localObjectStorage->detach($participation);
		$this->fixture->addParticipation($participation);
		$this->fixture->removeParticipation($participation);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getParticipations()
		);
	}
	
}
?>