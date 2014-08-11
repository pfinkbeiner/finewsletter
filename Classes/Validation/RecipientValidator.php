<?php
namespace FI\Finewsletter\Validation;

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
 * Finewsletter
 *
 * @package Finewsletter
 */ 
class RecipientValidator {

	/**
	 * finewsletterRepository
	 *
	 * @var \FI\Finewsletter\Domain\Repository\RecipientRepository
	 * @inject
	 */
	protected $recipientRepository = NULL;

	/**
	 * Is email unique?
	 *
	 * @param \string $email
	 * @return \boolean
	 */
	public function isEmailUnique($email) {
		$status = FALSE;
		if (count($this->recipientRepository->findOneByEmail($email)) === 0) {
			$status = !$status;
		}
		return $status;
	}

	/**
	 * Is given e-mail address valid? 
	 *
	 * @param \string $email
	 * @return \boolean
	 */
	public function isEmailValid($email) {
		$status = FALSE;
		if(!empty($email) && preg_match(' / ^[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)* @ (?: (?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[a-z]{2}|aero|asia|biz|cat|com|edu|coop|gov|info|int|invalid|jobs|localdomain|mil|mobi|museum|name|net|org|pro|tel|travel)| localhost| (?:(?:\d{1,2}|1\d{1,2}|2[0-5][0-5])\.){3}(?:(?:\d{1,2}|1\d{1,2}|2[0-5][0-5]))) \b /ix', $email)) {
			$status = TRUE;
		}
		return $status;
	}
}