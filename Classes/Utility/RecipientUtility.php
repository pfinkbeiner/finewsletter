<?php
namespace FI\Finewsletter\Utility;

/***************************************************************
*  Copyright notice
*
*  (c) 2014 Patrick Finkbeiner <mail@finkbeiner.me>, finkbeiner.me
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
 * General utility provides some usefull functions
 *
 * @package Finewsletter
 */ 
class RecipientUtility {

	/**
	 * Generates a confirmation link for given recipient
	 *
	 * @param \FI\Finewsletter\Domain\Model\Recipient $recipient
	 * @param \TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder $uriBuilder
	 * @return \string
	 */
	public function generateConfirmationLink(\FI\Finewsletter\Domain\Model\Recipient $recipient, \TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder $uriBuilder) {
		$uri = $uriBuilder
			->reset()
			->setCreateAbsoluteUri(TRUE)
			->setUseCacheHash(FALSE)
			->uriFor('verify', array(
				'recipient' => $recipient, 
				'hash' => $recipient->getToken()
			), 'Recipient', 'finewsletter', 'subscribe');
		return $uri;
	}

	/**
	 * Check if confirmation link is valid
	 *
	 * @param \FI\Finewsletter\Domain\Model\Recipient $recipient
	 * @param \string $hash
	 * @return \boolean
	 */
	public function isConfirmationHashValid(\FI\Finewsletter\Domain\Model\Recipient $recipient, $hash) {
		$status = FALSE;
		// First, check if hash equals token
		if($recipient->getToken() === $hash) {
			$status = !$status;
		}
		return $status;
	} 

	/**
	 * Is link expired
	 *
	 * @param \FI\Finewsletter\Domain\Model\Recipient $recipient
	 * @param \integer $expirationTime
	 * @return \boolean
	 */
	public function isConfirmationLinkExpired(\FI\Finewsletter\Domain\Model\Recipient $recipient, $expirationTime) {
		$status = TRUE;

		if($expirationTime === 0) {
			// No valid expiration time set…
			$status = !$status;
		} else {
			$creationDate = $recipient->getCrdate()->getTimestamp();
			$expirationDate = $recipient->getCrdate()->getTimestamp() + $expirationTime;

			if($creationDate <= $expirationDate) {
				$status = !$status;
			}
		}

		return $status;
	}
}