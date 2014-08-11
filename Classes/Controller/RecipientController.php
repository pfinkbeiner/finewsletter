<?php
namespace FI\Finewsletter\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Patrick Finkbeiner <mail@finkbeiner.me>, finkbeiner.me
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
 * RecipientController
 */
class RecipientController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * recipientRepository
	 *
	 * @var \FI\Finewsletter\Domain\Repository\RecipientRepository
	 * @inject
	 */
	protected $recipientRepository = NULL;

	/**
	 * action new
	 *
	 * @param \FI\Finewsletter\Domain\Model\Recipient $newRecipient
	 * @ignorevalidation $newRecipient
	 * @return void
	 */
	public function newAction(\FI\Finewsletter\Domain\Model\Recipient $newRecipient = NULL) {
		$this->view->assign('newRecipient', $newRecipient);
	}

	/**
	 * action create
	 *
	 * @param \FI\Finewsletter\Domain\Model\Recipient $newRecipient
	 * @return void
	 */
	public function createAction(\FI\Finewsletter\Domain\Model\Recipient $newRecipient) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->recipientRepository->add($newRecipient);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \FI\Finewsletter\Domain\Model\Recipient $recipient
	 * @ignorevalidation $recipient
	 * @return void
	 */
	public function editAction(\FI\Finewsletter\Domain\Model\Recipient $recipient) {
		$this->view->assign('recipient', $recipient);
	}

	/**
	 * action update
	 *
	 * @param \FI\Finewsletter\Domain\Model\Recipient $recipient
	 * @return void
	 */
	public function updateAction(\FI\Finewsletter\Domain\Model\Recipient $recipient) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->recipientRepository->update($recipient);
		$this->redirect('list');
	}

}