<?php
namespace FI\Finewsletter\Tests\Unit\Controller;
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
 * Test case for class FI\Finewsletter\Controller\RecipientController.
 *
 * @author Patrick Finkbeiner <mail@finkbeiner.me>
 */
class RecipientControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \FI\Finewsletter\Controller\RecipientController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('FI\\Finewsletter\\Controller\\RecipientController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenRecipientToView() {
		$recipient = new \FI\Finewsletter\Domain\Model\Recipient();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newRecipient', $recipient);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($recipient);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenRecipientToRecipientRepository() {
		$recipient = new \FI\Finewsletter\Domain\Model\Recipient();

		$recipientRepository = $this->getMock('FI\\Finewsletter\\Domain\\Repository\\RecipientRepository', array('add'), array(), '', FALSE);
		$recipientRepository->expects($this->once())->method('add')->with($recipient);
		$this->inject($this->subject, 'recipientRepository', $recipientRepository);

		$this->subject->createAction($recipient);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenRecipientToView() {
		$recipient = new \FI\Finewsletter\Domain\Model\Recipient();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('recipient', $recipient);

		$this->subject->editAction($recipient);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenRecipientInRecipientRepository() {
		$recipient = new \FI\Finewsletter\Domain\Model\Recipient();

		$recipientRepository = $this->getMock('FI\\Finewsletter\\Domain\\Repository\\RecipientRepository', array('update'), array(), '', FALSE);
		$recipientRepository->expects($this->once())->method('update')->with($recipient);
		$this->inject($this->subject, 'recipientRepository', $recipientRepository);

		$this->subject->updateAction($recipient);
	}
}
