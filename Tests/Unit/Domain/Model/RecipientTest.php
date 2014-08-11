<?php

namespace FI\Finewsletter\Tests\Unit\Domain\Model;

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
 * Test case for class \FI\Finewsletter\Domain\Model\Recipient.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Patrick Finkbeiner <mail@finkbeiner.me>
 */
class RecipientTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \FI\Finewsletter\Domain\Model\Recipient
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \FI\Finewsletter\Domain\Model\Recipient();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getEmailReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getEmail()
		);
	}

	/**
	 * @test
	 */
	public function setEmailForStringSetsEmail() {
		$this->subject->setEmail('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'email',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTokenReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getToken()
		);
	}

	/**
	 * @test
	 */
	public function setTokenForStringSetsToken() {
		$this->subject->setToken('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'token',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getActiveReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getActive()
		);
	}

	/**
	 * @test
	 */
	public function setActiveForBooleanSetsActive() {
		$this->subject->setActive(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'active',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getUseragentReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getUseragent()
		);
	}

	/**
	 * @test
	 */
	public function setUseragentForStringSetsUseragent() {
		$this->subject->setUseragent('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'useragent',
			$this->subject
		);
	}
}
