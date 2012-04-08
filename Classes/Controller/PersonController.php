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
 * @package sjwishlist
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_Sjwishlist_Controller_PersonController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * personRepository
	 *
	 * @var Tx_Sjwishlist_Domain_Repository_PersonRepository
	 */
	protected $personRepository;

	/**
	 * injectPersonRepository
	 *
	 * @param Tx_Sjwishlist_Domain_Repository_PersonRepository $personRepository
	 * @return void
	 */
	public function injectPersonRepository(Tx_Sjwishlist_Domain_Repository_PersonRepository $personRepository) {
		$this->personRepository = $personRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$persons = $this->personRepository->findAll();
		$this->view->assign('persons', $persons);
	}

	/**
	 * action show
	 *
	 * @param $person
	 * @return void
	 */
	public function showAction(Tx_Sjwishlist_Domain_Model_Person $person) {
		$this->view->assign('person', $person);
	}

	/**
	 * action new
	 *
	 * @param $newPerson
	 * @dontvalidate $newPerson
	 * @return void
	 */
	public function newAction(Tx_Sjwishlist_Domain_Model_Person $newPerson = NULL) {
		$this->view->assign('newPerson', $newPerson);
	}

	/**
	 * action create
	 *
	 * @param $newPerson
	 * @return void
	 */
	public function createAction(Tx_Sjwishlist_Domain_Model_Person $newPerson) {
		$this->personRepository->add($newPerson);
		$this->flashMessageContainer->add('Your new Person was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $person
	 * @return void
	 */
	public function editAction(Tx_Sjwishlist_Domain_Model_Person $person) {
		$this->view->assign('person', $person);
	}

	/**
	 * action update
	 *
	 * @param $person
	 * @return void
	 */
	public function updateAction(Tx_Sjwishlist_Domain_Model_Person $person) {
		$this->personRepository->update($person);
		$this->flashMessageContainer->add('Your Person was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $person
	 * @return void
	 */
	public function deleteAction(Tx_Sjwishlist_Domain_Model_Person $person) {
		$this->personRepository->remove($person);
		$this->flashMessageContainer->add('Your Person was removed.');
		$this->redirect('list');
	}

}
?>