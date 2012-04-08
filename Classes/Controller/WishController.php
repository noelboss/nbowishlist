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
class Tx_Sjwishlist_Controller_WishController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * wishRepository
	 *
	 * @var Tx_Sjwishlist_Domain_Repository_WishRepository
	 */
	protected $wishRepository;

	/**
	 * injectWishRepository
	 *
	 * @param Tx_Sjwishlist_Domain_Repository_WishRepository $wishRepository
	 * @return void
	 */
	public function injectWishRepository(Tx_Sjwishlist_Domain_Repository_WishRepository $wishRepository) {
		$this->wishRepository = $wishRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$wishes = $this->wishRepository->findAll();
		$this->view->assign('wishes', $wishes);
	}

	/**
	 * action show
	 *
	 * @param $wish
	 * @return void
	 */
	public function showAction(Tx_Sjwishlist_Domain_Model_Wish $wish) {
		$this->view->assign('wish', $wish);
	}

	/**
	 * action new
	 *
	 * @param $newWish
	 * @dontvalidate $newWish
	 * @return void
	 */
	public function newAction(Tx_Sjwishlist_Domain_Model_Wish $newWish = NULL) {
		$this->view->assign('newWish', $newWish);
	}

	/**
	 * action create
	 *
	 * @param $newWish
	 * @return void
	 */
	public function createAction(Tx_Sjwishlist_Domain_Model_Wish $newWish) {
		$this->wishRepository->add($newWish);
		$this->flashMessageContainer->add('Your new Wish was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $wish
	 * @return void
	 */
	public function editAction(Tx_Sjwishlist_Domain_Model_Wish $wish) {
		$this->view->assign('wish', $wish);
	}

	/**
	 * action update
	 *
	 * @param $wish
	 * @return void
	 */
	public function updateAction(Tx_Sjwishlist_Domain_Model_Wish $wish) {
		$this->wishRepository->update($wish);
		$this->flashMessageContainer->add('Your Wish was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $wish
	 * @return void
	 */
	public function deleteAction(Tx_Sjwishlist_Domain_Model_Wish $wish) {
		$this->wishRepository->remove($wish);
		$this->flashMessageContainer->add('Your Wish was removed.');
		$this->redirect('list');
	}

}
?>