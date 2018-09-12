<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 29. 1. 2018
 * Time: 4:47
 */

namespace App\Model\Service;


use App\Model\Entity\Member;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\EOFException;
use App\Model\Exception\FileParseException;
use App\Model\Exception\NotFoundException;

interface IFileService
{
	/**
	 * @param Member $member
	 * @return string
	 */
	public function getBackup(Member $member): string;

	/**
	 * @param Member $member
	 * @param string $content
	 * @return bool
	 * @throws FileParseException
	 * @throws EOFException
     * @throws NotFoundException
     * @throws BadParameterException
	 */
	public function storeBackup(Member $member, string $content): bool;
}
