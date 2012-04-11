<?php

/* * *************************************************************
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
 * ************************************************************* */

/**
 *
 *
 * @package sjwishs
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_Nbowishlist_Controller_ParticipationController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 *
	 * participationRepository
	 *
	 * @var Tx_Nbowishlist_Domain_Repository_ParticipationRepository
	 */
	protected $participationRepository;

	/**
	 * injectParticipationRepository
	 *
	 * @param Tx_Nbowishlist_Domain_Repository_ParticipationRepository $participationRepository
	 * @return void
	 */
	public function injectParticipationRepository(Tx_Nbowishlist_Domain_Repository_ParticipationRepository $participationRepository) {
		$this->participationRepository = $participationRepository;
	}

	/**
	 * personRepository
	 *
	 * @var Tx_Nbowishlist_Domain_Repository_PersonRepository
	 */
	protected $personRepository;

	/**
	 * injectPersonRepository
	 *
	 * @param Tx_Nbowishlist_Domain_Repository_PersonRepository $personRepository
	 * @return void
	 */
	public function injectPersonRepository(Tx_Nbowishlist_Domain_Repository_PersonRepository $personRepository) {
		$this->personRepository = $personRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$participations = $this->participationRepository->findAll();
		$this->view->assign('participations', $participations);
	}

	/**
	 * action show
	 *
	 * @param $participation
	 * @return void
	 */
	public function showAction(Tx_Nbowishlist_Domain_Model_Participation $participation) {
		$this->view->assign('participation', $participation);
	}

	/**
	 * action new
	 *
	 * @param $wish
	 * @param $newParticipation
	 * @param $newPerson
	 *
	 * @dontverifyrequesthash
	 * @return void
	 */
	public function newAction(Tx_Nbowishlist_Domain_Model_Wish $wish, Tx_Nbowishlist_Domain_Model_Participation $newParticipation = NULL, Tx_Nbowishlist_Domain_Model_Person $newPerson = NULL) {
		if (!isset($newPerson)) {
			$uid = Tx_Nboevents_Utility_Cookies::getCookieValue('Participation'.$wish->getUid());
			if ($this->participationRepository->countByUid($uid) > 0) {
				$newParticipation = $uid;
				$person = $this->participationRepository->personByUid($newParticipation);
				if($this->personRepository->countByUid($person)){
					$this->redirect(
							'edit', NULL, NULL, array(
							'newParticipation' => $newParticipation,
							'newPerson' => $person,
							'wish' => $wish,
						)
					);
				}
			}
			$pid = Tx_Nboevents_Utility_Cookies::getCookieValue('Person');
			$newPerson = $this->personRepository->findByUid($pid);
		}
		$this->view->assign('e', $e);		
		$this->view->assign('wish', $wish);
		$this->view->assign('newPerson', $newPerson);
		$this->view->assign('newParticipation', $newParticipation);
	}

	/**
	 * action create
	 *
	 * @param $newParticipation
	 * @param $newPerson
	 * @param $wish
	 * @return void
	 * @dontverifyrequesthash
	 */
	public function createAction(Tx_Nbowishlist_Domain_Model_Participation $newParticipation, Tx_Nbowishlist_Domain_Model_Person $newPerson, Tx_Nbowishlist_Domain_Model_Wish $wish) {

		$this->participationRepository->add($newParticipation);
		$newParticipation->setShare($newParticipation->getShare());
		if (!$newPerson->getUid()) {
			$this->personRepository->add($newPerson);
		} else {
			$this->personRepository->update($newPerson);
		}

		//Enforce persistence
		$persistenceManager = t3lib_div::makeInstance('Tx_Extbase_Persistence_Manager');
		$persistenceManager->persistAll();

		$newPerson->addParticipation($newParticipation);
		$wish->addParticipation($newParticipation);

		Tx_Nboevents_Utility_Cookies::setCookieValue('Participation'.$wish->getUid(), $newParticipation->getUid());
		Tx_Nboevents_Utility_Cookies::setCookieValue('Person', $newPerson->getUid());

		$this->flashMessageContainer->add('<h3>Danke ' . ($newPerson->getFirstname()) . ' ' . ($newPerson->getLastname()) . '!</h3>Du beteiligst Dich mit ' . ($newParticipation->getShare()) . ' CHF an diesem Geschenk.');
		$this->redirect('show', 'Wish', NULL, array('wish' => $wish->getUid()));
	}

	/**
	 * action edit
	 *
	 * @param $newParticipation
	 * @param $newPerson
	 * @param $wish
	 * @dontvalidate $newParticipation
	 * @dontvalidate $newPerson
	 * @dontverifyrequesthash
	 * @return void
	 */
	public function editAction(Tx_Nbowishlist_Domain_Model_Participation $newParticipation, Tx_Nbowishlist_Domain_Model_Person $newPerson, Tx_Nbowishlist_Domain_Model_Wish $wish) {
		$this->view->assign('wish', $wish);
		$this->view->assign('newParticipation', $newParticipation);
		$this->view->assign('newPerson', $newPerson);
	}

	/**
	 * action update
	 *
	 * @param $newParticipation
	 * @param $newPerson
	 * @param $wish
	 * @dontverifyrequesthash
	 * @return void
	 */
	public function updateAction(Tx_Nbowishlist_Domain_Model_Participation $newParticipation, Tx_Nbowishlist_Domain_Model_Person $newPerson, Tx_Nbowishlist_Domain_Model_Wish $wish) {
		$this->participationRepository->update($newParticipation);
		$this->personRepository->update($newPerson);

		Tx_Nboevents_Utility_Cookies::setCookieValue('Person', $newPerson->getUid());

		$this->flashMessageContainer->add('<h3>Danke ' . ($newPerson->getFirstname()) . ' ' . ($newPerson->getLastname()) . '!</h3>Du beteiligst Dich mit ' . ($newParticipation->getShare()) . ' CHF an diesem Geschenk.');
		$this->redirect('show', 'Wish', NULL, array('wish' => $wish->getUid()));
	}

	/**
	 * action delete
	 *
	 * @param $participation
	 * @param $wish
	 * @return void
	 */
	public function deleteAction(Tx_Nbowishlist_Domain_Model_Participation $participation, Tx_Nbowishlist_Domain_Model_Wish $wish) {
		$this->participationRepository->remove($participation);
		Tx_Nboevents_Utility_Cookies::setCookieValue('Participation'.$wish->getUid(), NULL);

		$this->flashMessageContainer->add('<h3>Danke!</h3>Deine Geschenk-Beitrag wurde gelöscht.');
		$this->redirect('show', 'Wish', NULL, array('wish' => $wish));
	}
	

}

?>