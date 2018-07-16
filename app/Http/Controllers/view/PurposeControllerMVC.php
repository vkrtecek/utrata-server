<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 2. 7. 2018
 * Time: 15:01
 */

namespace App\Http\Controllers;


use App\Model\Exception\AlreadyExistException;
use App\Model\Service\IMemberService;
use App\Model\Service\IPurposeService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PurposeControllerMVC extends AbstractControllerMVC
{
	/** @var IPurposeService */
	protected $purposeService;

	/**
	 * PurposeControllerMVC constructor.
	 * @param IMemberService $memberService
	 * @param IPurposeService $purposeService
	 */
	public function __construct(IMemberService $memberService, IPurposeService $purposeService) {
		parent::__construct($memberService);
		$this->purposeService = $purposeService;
	}

	/**
	 * @return View
	 */
	public function manage() {
		$this->assumeLogged();
		$member = Auth::user();
		$purposes = $this->purposeService->getLanguagePurposes($member->getLanguage()->getCode());
		foreach ($this->purposeService->getPurposesCreatedByUser($member) as $purpose) {
			if (!in_array($purpose, $purposes))
				array_push($purposes, $purpose);
		}
		usort($purposes, function($a, $b) {
			return $a->getId() > $b->getId() ? 1 : -1;
		});
		$purposes = $this->purposeService->formatEntities($purposes, $member);
		$usingNotes = $this->purposeService->getUserPurposes($member);
		$usingNotes = array_map(function($val) {
			return $val->getId();
		}, $usingNotes);
		return view('pages.managePurposes')
			->with('notes', $purposes)
			->with('usingNotes', $usingNotes);
	}

	/**
	 * @param Request $request
	 * @return View|Redirect
	 */
	public function create(Request $request) {
		$this->assumeLogged();
		$member = Auth::user();
		try {
			$this->purposeService->createPurpose($member, $request->all());
		} catch (AlreadyExistException $ex) {
			$purposes = $this->purposeService->getLanguagePurposes($member->getLanguage()->getCode());
			foreach ($this->purposeService->getPurposesCreatedByUser($member) as $purpose) {
				if (!in_array($purpose, $purposes))
					array_push($purposes, $purpose);
			}
			usort($purposes, function($a, $b) {
				return $a->getId() > $b->getId() ? 1 : -1;
			});
			$purposes = $this->purposeService->formatEntities($purposes, $member);
			$usingNotes = $this->purposeService->getUserPurposes($member);
			$usingNotes = array_map(function($val) {
				return $val->getId();
			}, $usingNotes);
			return view('pages.managePurposes')
				->with('notes', $purposes)
				->with('usingNotes', $usingNotes)
				->with('warning', $ex->getMessage());
		}
		return redirect(route('get.purposes.manage'));
	}

	public function createConnection(Request $request) {

	}

	/**
	 * Deletes purpose by id
	 * @param int $id
	 * @return Redirect
	 */
	public function delete($id) {
		$this->assumeLogged();
		$this->purposeService->deletePurpose($id, Auth::user());
		return redirect(route('get.purposes.manage'));
	}

	/**
	 * Deletes MemberPurpose
	 * @param Request $request
	 */
	public function deleteConnection(Request $request) {

	}
}