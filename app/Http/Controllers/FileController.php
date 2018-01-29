<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 29. 1. 2018
 * Time: 4:45
 */

namespace App\Http\Controllers;


use App\Model\Service\IFileService;
use App\Model\Service\IMemberService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FileController extends AbstractController
{
	/** @var IFileService */
	protected $fileService;

	/**
	 * FileController constructor.
	 * @param IMemberService $memberService
	 * @param IFileService $fileService
	 */
	public function __construct(IMemberService $memberService, IFileService $fileService) {
		parent::__construct($memberService);
		$this->fileService = $fileService;
	}

	public function backup(Request $req) {
		$this->assumeLogged($req);
		$member = $this->loggedUser($req);
		try {
			$file = $this->fileService->getBackup($member);
		} catch (\Exception $ex) {
			return Response::create($ex->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
		}
		return Response::create(['content' => $file], Response::HTTP_OK);
	}

	public function store(Request $req) {
		$this->assumeLogged($req);
		$member = $this->loggedUser($req);
		$file = $req->get('file');
		try {
			$bool = $this->fileService->storeBackup($member, $file);
		} catch (\Exception $ex) {
			return Response::create($ex->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
		}
		return Response::create(['success' => $bool], Response::HTTP_OK);
	}

}