<?php

namespace App\Http\Controllers;

use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\IItemService;
use App\Model\Service\IMemberService;
use App\Model\Service\ItemService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemController extends AbstractController
{

	/**
	 * @var IItemService
	 */
	protected $itemService;


	/**
	 * ItemController constructor.
	 * @param IMemberService $memberService
	 * @param IItemService $itemService
	 */
	public function __construct(IMemberService $memberService, IItemService $itemService) {
		parent::__construct($memberService);
		$this->itemService = $itemService;
	}

	/**
	 * @param Request $req
	 * @param int $walletId
	 * @return Response
	 */
	public function getWalletItems(Request $req, $walletId) {
		$member = $this->loggedUser($req);
		$state = $req->get('state');
		$month = $req->get('month');
		$notes = $req->get('notes');
		$year = $req->get('year');
		$pattern = $req->get('pattern');
		$orderBy = $req->get('orderBy');
		$orderHow = $req->get('orderHow');

		try {
			$items = $this->itemService->getWalletItems($walletId, $member, $state, $month, $notes, $year, $pattern, $orderBy, $orderHow);
			$formatted = ItemService::formatEntites($items);
		} catch (NotFoundException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_NO_CONTENT);
		} catch (BadParameterException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
		} catch (AuthenticationException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_UNAUTHORIZED);
		}
		return Response::create($formatted, Response::HTTP_OK);
	}





	/**
	 * @param Request $req
	 * @return Response
	 */
	public function create(Request $req) {
		dump(json_decode($req->getContent(), true));
		return Response::create($req, Response::HTTP_CREATED);
	}

	/**
	 * @param Request $req
	 * @param int $id
	 * @return Response
	 */
	public function check(Request $req, $id) {
		$this->assumeLogged($req);

		try {
			$this->itemService->checkItem($id);
		} catch (NotFoundException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_NOT_FOUND);
		}
		return Response::create($id, Response::HTTP_OK);
	}

	/**
	 * @param Request $req
	 * @return Response
	 */
	public function checkAll(Request $req) {
		$member = $this->loggedUser($req);
		$walletId = $req->get('wallet');
		$month = $req->get('month');
		$notes = $req->get('notes');
		$year = $req->get('year');
		$pattern = $req->get('pattern');
		$orderBy = $req->get('orderBy');
		$orderHow = $req->get('orderHow');
		try {
			$res = $this->itemService->checkAll($walletId, $member, $month, $notes, $year, $pattern, $orderBy, $orderHow);
		} catch (\Exception $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
		}
		return Response::create($res, Response::HTTP_OK);
	}









	/**
	 * @param Request $req
	 * @param $id
	 * @return Response
	 */
	protected function delete(Request $req, $id) {
		$this->assumeLogged($req);

		try {
			$this->itemService->deleteItem($id);
		} catch (NotFoundException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_NOT_FOUND);
		} catch (BadParameterException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
		} catch (IntegrityException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_METHOD_NOT_ALLOWED);
		}

		return Response::create($id, Response::HTTP_OK);
	}
}
