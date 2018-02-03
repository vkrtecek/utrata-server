<?php

namespace App\Http\Controllers;

use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\IItemService;
use App\Model\Service\IMemberService;
use App\Model\Service\ItemService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

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
		$limit = $req->get('limit');

		try {
			$items = $this->itemService->getWalletItems($walletId, $member, $state, $month, $notes, $year, $pattern, $orderBy, $orderHow, $limit);
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
		$this->assumeLogged($req);
		$member = $this->loggedUser($req);
		$data = $req->get('item');

		try {
			$item = $this->itemService->createItem($member, $data);
			$formatted = ItemService::format($item);
		} catch (AlreadyExistException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
		} catch (NotFoundException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
		} catch (BadRequestHttpException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
		}

		return Response::create(['success' => $formatted], Response::HTTP_CREATED);
	}

	/**
	 * @param Request $req
	 * @param int $id
	 * @return Response
	 */
	public function check(Request $req, $id) {
		$this->assumeLogged($req);
		$member = $this->loggedUser($req);

		try {
			$this->itemService->checkItem($member, $id);
		} catch (NotFoundException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_NOT_FOUND);
		} catch (AuthenticationException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_UNAUTHORIZED);
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
		$limit = $req->get('limit');
		try {
			$res = $this->itemService->checkAll($walletId, $member, $month, $notes, $year, $pattern, $orderBy, $orderHow, $limit);
		} catch (NotFoundException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
		} catch (BadParameterException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_NOT_ACCEPTABLE);
		} catch (AuthenticationException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
		}
		return Response::create($res, Response::HTTP_OK);
	}


	/**
	 * @param Request $req
	 * @return Response
	 */
	public function update(Request $req) {
		$this->assumeLogged($req);
		$member = $this->loggedUser($req);
		$data = $req->get('item');
		if (!$data || !isset($data['id']))
			return Response::create(['error' => 'Item missing'], Response::HTTP_BAD_REQUEST);

		try {
			$item = $this->itemService->updateItem($member, $data['id'], $data);
			$formatted = ItemService::format($item);
		} catch (NotFoundException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
		} catch (BadParameterException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_NOT_ACCEPTABLE);
		} catch (BadRequestHttpException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
		}

		return Response::create($formatted, Response::HTTP_ACCEPTED);
	}


	/**
	 * @param Request $req
	 * @param $id
	 * @return Response
	 */
	protected function delete(Request $req, $id) {
		$this->assumeLogged($req);
		$member = $this->loggedUser($req);

		try {
			$this->itemService->deleteItem($member, $id);
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
