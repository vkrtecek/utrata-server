<?php

namespace App\Http\Controllers;

use App\Http\Pagination;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\IItemService;
use App\Model\Service\IMemberService;
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
     * @throws AuthenticationException
	 */
	public function getWalletItems(Request $req, $walletId) {
	    $this->assumeLogged($req);

		try {
		    $filter = Pagination::create($req, 'Item');
		    $filter->setWalletId($walletId)->setMember($this->member);
			$items = $this->itemService->getWalletItems($walletId, $this->member, $filter);
			$formatted = $this->itemService->formatEntities($items, $this->member);
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
     * @throws AuthenticationException
	 */
	public function statistics(Request $req) {
		$this->assumeLogged($req);
		$walletId = $req->get('id');
		$purposes = $req->get('notes');
		try {
			$statistics = $this->itemService->getMonthStatistics($this->member, $walletId, $purposes);
		} catch (NotFoundException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_NO_CONTENT);
		} catch (BadParameterException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
		} catch (AuthenticationException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_UNAUTHORIZED);
		}
		return Response::create($statistics, Response::HTTP_OK);
	}





	/**
	 * @param Request $req
	 * @return Response
     * @throws AuthenticationException
	 */
	public function create(Request $req) {
		$this->assumeLogged($req);
		$data = $req->get('item');

		try {
			$item = $this->itemService->createItem($this->member, $data);
			$formatted = $this->itemService->format($item, $this->member);
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
     * @throws AuthenticationException
     * @throws BadParameterException
	 */
	public function check(Request $req, $id) {
		$this->assumeLogged($req);

		try {
			$this->itemService->checkItem($this->member, $id);
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
     * @throws AuthenticationException
	 */
	public function checkAll(Request $req) {
		$this->assumeLogged($req);
		try {
            $filter = Pagination::create($req, 'Item');
            $filter->setWalletId($req->get('wallet'))->setMember($this->member);
			$res = $this->itemService->checkAll($req->get('wallet'), $this->member, $filter);
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
     * @throws AuthenticationException
	 */
	public function update(Request $req) {
		$this->assumeLogged($req);
		$data = $req->get('item');
		if (!$data || !isset($data['id']))
			return Response::create(['error' => 'Item missing'], Response::HTTP_BAD_REQUEST);

		try {
			$item = $this->itemService->updateItem($this->member, $data['id'], $data);
			$formatted = $this->itemService->format($item, $this->member);
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
	 * @param int $id
	 * @return Response
     * @throws AuthenticationException
	 */
	protected function delete(Request $req, $id) {
		$this->assumeLogged($req);

		try {
			$this->itemService->deleteItem($this->member, $id);
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
