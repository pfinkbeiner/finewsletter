<?php
namespace FI\Finewsletter\Domain\Model;


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
 * Recipient
 */
class Recipient extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * email
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $email = '';

	/**
	 * token
	 *
	 * @var string
	 */
	protected $token = '';

	/**
	 * active
	 *
	 * @var boolean
	 */
	protected $active = FALSE;

	/**
	 * useragent
	 *
	 * @var string
	 */
	protected $useragent = '';

	/**
	 * crdate
	 *
	 * @var DateTime
	 */
	protected $crdate;

	/**
	 * Returns the email
	 *
	 * @return string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Returns the token
	 *
	 * @return string $token
	 */
	public function getToken() {
		return $this->token;
	}

	/**
	 * Sets the token
	 *
	 * @param string $token
	 * @return void
	 */
	public function setToken($token) {
		$this->token = $token;
	}

	/**
	 * Returns the active
	 *
	 * @return boolean $active
	 */
	public function getActive() {
		return $this->active;
	}

	/**
	 * Sets the active
	 *
	 * @param boolean $active
	 * @return void
	 */
	public function setActive($active) {
		$this->active = $active;
	}

	/**
	 * Returns the boolean state of active
	 *
	 * @return boolean
	 */
	public function isActive() {
		return $this->active;
	}

	/**
	 * Returns the useragent
	 *
	 * @return string $useragent
	 */
	public function getUseragent() {
		return $this->useragent;
	}

	/**
	 * Sets the useragent
	 *
	 * @param string $useragent
	 * @return void
	 */
	public function setUseragent($useragent) {
		$this->useragent = $useragent;
	}

	/**
	 * Returns the crdate
	 *
	 * @return DateTime $crdate
	 */
	public function setCrdate(\DateTime $crdate) {
		$this->crdate = $crdate;
	}

	/**
	 * Returns the crdate
	 *
	 * @return DateTime $crdate
	 */
	public function getCrdate() {
		return $this->crdate;
	}

}