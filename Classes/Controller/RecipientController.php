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
	 * recipientValidator
	 *
	 * @var \FI\Finewsletter\Validation\RecipientValidator
	 * @inject
	 */
	protected $recipientValidator = NULL;

	/**
	 * persistenceManager
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 * @inject
	 */
	protected $persistenceManager = NULL;

	/**
	 * action new
	 *
	 * @param \FI\Finewsletter\Domain\Model\Recipient $newRecipient
	 * @ignorevalidation $newRecipient
	 * @return void
	 */
	public function subscribeAction(\FI\Finewsletter\Domain\Model\Recipient $newRecipient = NULL) {
		$this->view->assign('newRecipient', $newRecipient);
	}

	/**
	 * action create
	 *
	 * @param \FI\Finewsletter\Domain\Model\Recipient $newRecipient
	 * @return void
	 */
	public function createAction(\FI\Finewsletter\Domain\Model\Recipient $newRecipient) {
		// Check if e-mail address is valid.
		if($this->recipientValidator->isEmailValid($newRecipient->getEmail()) === TRUE) {

			// Check if e-mail address is already in use.
			if($this->recipientValidator->isEmailUnique($newRecipient->getEmail()) === TRUE) {
				$hashService = $this->objectManager->get('\\TYPO3\\CMS\\Extbase\\Security\\Cryptography\\HashService');
				$newRecipient->setToken(
					$hashService->generateHmac($newRecipient->getEmail())
				);

				$newRecipient->setUseragent($_SERVER['HTTP_USER_AGENT']);
				$this->recipientRepository->add($newRecipient);
				$this->persistenceManager->persistAll();

				$recipientUtility = $this->objectManager->get('\\FI\\Finewsletter\\Utility\\RecipientUtility');
				$uriBuilder = $this->objectManager->get('\\TYPO3\\CMS\\Extbase\\Mvc\\Web\\Routing\\UriBuilder');

				$mailService = $this->objectManager->get('\\FI\\Finewsletter\\Service\\MailService');
				$emailContent = $mailService->generateEmailContent(array(
					'html'  => $this->settings['mail']['recipient']['subscribe']['templates']['html'],
					'plain' => $this->settings['mail']['recipient']['subscribe']['templates']['plain']
				), array(
					'confirmationLink' => $recipientUtility->generateConfirmationLink($newRecipient, $uriBuilder)
				), TRUE, TRUE);

				$mailService->sendMail(
					$this->objectManager->get('TYPO3\\CMS\\Core\\Mail\\MailMessage'),
					$newRecipient->getEmail(),
					$this->settings['mail']['recipient']['subscribe']['subject'],
					$emailContent['html'],
					$emailContent['plain'],
					$this->settings['mail']
				);


				$this->addFlashMessage(
					$this->settings['flashMessages']['notice']['confirmationMailSent'],
					'',
					\TYPO3\CMS\Core\Messaging\AbstractMessage::NOTICE
				);
			} else {
				$this->addFlashMessage(
					$this->settings['flashMessages']['error']['emailNotUnique'],
					'',
					\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
				);
			}

		} else {
			$this->addFlashMessage(
				$this->settings['flashMessages']['error']['invalidEmail'],
				'',
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
			);
		}

		$this->redirect('subscribe');
	}

	/**
	 * verify Action
	 *
	 * @param \FI\Finewsletter\Domain\Model\Recipient $recipient
	 * @param \string $hash
	 * @return void
	 */
	public function verifyAction(\FI\Finewsletter\Domain\Model\Recipient $recipient, $hash) {
		$recipientUtility = $this->objectManager->get('\\FI\\Finewsletter\\Utility\\RecipientUtility');
		if($recipientUtility->isConfirmationLinkValid($recipient, $hash, $this->settings) === TRUE) {
			$recipient->setActive(TRUE);
			$this->recipientRepository->update($recipient);
		} else {

		}
	}

}