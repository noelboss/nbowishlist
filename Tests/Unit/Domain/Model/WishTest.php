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
 * Test case for class Tx_Sjwishlist_Domain_Model_Wish.
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
class Tx_Sjwishlist_Domain_Model_WishTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Sjwishlist_Domain_Model_Wish
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Sjwishlist_Domain_Model_Wish();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() { 
		$this->fixture->setTitle('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getTitle()
		);
	}
	
	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() { 
		$this->fixture->setDescription('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDescription()
		);
	}
	
	/**
	 * @test
	 */
	public function getPriceReturnsInitialValueForFloat() { 
		$this->assertSame(
			0.0,
			$this->fixture->getPrice()
		);
	}

	/**
	 * @test
	 */
	public function setPriceForFloatSetsPrice() { 
		$this->fixture->setPrice(3.14159265);

		$this->assertSame(
			3.14159265,
			$this->fixture->getPrice()
		);
	}
	
	/**
	 * @test
	 */
	public function getMinshareReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getMinshare()
		);
	}

	/**
	 * @test
	 */
	public function setMinshareForIntegerSetsMinshare() { 
		$this->fixture->setMinshare(12);

		$this->assertSame(
			12,
			$this->fixture->getMinshare()
		);
	}
	
	/**
	 * @test
	 */
	public function getNotesReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setNotesForStringSetsNotes() { 
		$this->fixture->setNotes('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getNotes()
		);
	}
	
	/**
	 * @test
	 */
	public function getImagesReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setImagesForStringSetsImages() { 
		$this->fixture->setImages('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getImages()
		);
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