<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 2. 7. 2018
 * Time: 15:01
 */

namespace App\Http\Controllers;


use App\Model\Entity\Purpose;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\AuthenticationMVCException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\IMemberService;
use App\Model\Service\IPurposeService;
use App\Model\Service\ITranslationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PurposeControllerMVC extends AbstractControllerMVC
{
	/** @var IPurposeService */
	protected $purposeService;

    /**
     * PurposeControllerMVC constructor.
     * @param IMemberService $memberService
     * @param ITranslationService $translationService
     * @param IPurposeService $purposeService
     */
	public function __construct(IMemberService $memberService, ITranslationService $translationService, IPurposeService $purposeService) {
		parent::__construct($memberService, $translationService);
		$this->purposeService = $purposeService;
	}

	/**
	 * @return View
	 * @throws AuthenticationException
	 * @throws NotFoundException
     * @throws BadParameterException
	 */
	public function manage() {
		$this->assumeLogged();
		$purposes = $this->purposeService->getLanguagePurposes($this->member->getLanguage()->getCode());
		foreach ($this->purposeService->getPurposesCreatedByUser($this->member) as $purpose) {
			if (!in_array($purpose, $purposes))
				array_push($purposes, $purpose);
		}
		usort($purposes, function(Purpose $a, Purpose $b) {
			return $a->getId() > $b->getId() ? 1 : -1;
		});
		$purposes = $this->purposeService->formatEntities($purposes, $this->member);
		$usingNotes = $this->purposeService->getUserPurposes($this->member);
		$usingNotes = array_map(function(Purpose $val) {
			return $val->getId();
		}, $usingNotes);
		return view('pages.managePurposes')
			->with('notes', $purposes)
			->with('usingNotes', $usingNotes);
	}

	/**
	 * @param Request $request
	 * @return Redirect|View
	 * @throws AuthenticationMVCException
	 * @throws NotFoundException
     * @throws BadParameterException
	 */
	public function create(Request $request) {
		$this->assumeLogged();
		try {
			$this->purposeService->createPurpose($this->member, $request->all());
		} catch (AlreadyExistException $ex) {
            $message = $this->trans->get($ex->getMessage(), $ex->getDefault());
			$purposes = $this->purposeService->getLanguagePurposes($this->member->getLanguage()->getCode());
			foreach ($this->purposeService->getPurposesCreatedByUser($this->member) as $purpose) {
				if (!in_array($purpose, $purposes))
					array_push($purposes, $purpose);
			}
			usort($purposes, function(Purpose $a, Purpose $b) {
				return $a->getId() > $b->getId() ? 1 : -1;
			});
			$purposes = $this->purposeService->formatEntities($purposes, $this->member);
			$usingNotes = $this->purposeService->getUserPurposes($this->member);
			$usingNotes = array_map(function(Purpose $val) {
				return $val->getId();
			}, $usingNotes);
			return view('pages.managePurposes')
				->with('notes', $purposes)
				->with('usingNotes', $usingNotes)
				->with('warning', $ex->bind($message));
		}
		return redirect(route('get.purposes.manage'));
	}

	public function createConnection(Request $request) {

	}

	/**
	 * @param int $id
	 * @return Redirect
	 * @throws \App\Model\Exception\AuthenticationMVCException
	 * @throws \App\Model\Exception\BadParameterException
	 * @throws \App\Model\Exception\IntegrityException
	 * @throws \App\Model\Exception\NotFoundException
	 */
	public function delete($id) {
		$this->assumeLogged();
		$this->purposeService->deletePurpose($id, $this->member);
		return redirect(route('get.purposes.manage'));
	}

	/**
	 * Deletes MemberPurpose
	 * @param Request $request
	 */
	public function deleteConnection(Request $request) {

	}
}
