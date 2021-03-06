<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 29. 1. 2018
 * Time: 4:47
 */

namespace App\Model\Service;


use App\Model\Entity\Member;
use App\Model\Exception\EOFException;
use App\Model\Exception\FileParseException;

interface IFileService
{
	/**
	 * @param Member $member
	 * @return string
	 */
	public function getBackup(Member $member);

	/**
	 * @param Member $member
	 * @param string $content
	 * @return boolean
	 * @throws FileParseException
	 * @throws EOFException
	 */
	public function storeBackup(Member $member, $content);
}