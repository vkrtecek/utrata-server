<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 6. 7. 2018
 * Time: 20:44
 */

namespace App\Http\Controllers;


use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\IMemberPurposeService;
use App\Model\Service\IMemberService;
use App\Model\Service\IPurposeService;
use App\Model\Service\ITranslationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MemberPurposeControllerMVC extends AbstractControllerMVC
{
	/** @var IMemberPurposeService */
	protected $memberPurposeService;

	/** @var IPurposeService */
	protected $purposeService;

    /**
     * MemberPurposeControllerMVC constructor.
     * @param IMemberService $memberService
     * @param ITranslationService $translationService
     * @param IMemberPurposeService $memberPurposeService
     * @param IPurposeService $purposeService
     */
	public function __construct(IMemberService $memberService, ITranslationService $translationService, IMemberPurposeService $memberPurposeService, IPurposeService $purposeService) {
		parent::__construct($memberService, $translationService);
		$this->memberPurposeService = $memberPurposeService;
		$this->purposeService = $purposeService;
	}

	/**
	 * @param Request $request
	 * @return Response
	 * @throws BadParameterException
	 * @throws NotFoundException
	 * @throws AuthenticationException
	 */
	public function create(Request $request) {
		$this->assumeLogged();
		$purpose = $this->purposeService->getPurpose($request->get('purpose'));
        $ret = $this->memberPurposeService->create($this->member, $purpose);
		return Response::create([
			'success' => true,
			'created' => $ret,
		], Response::HTTP_OK);
	}

	/**
	 * @param Request $request
	 * @return Response
	 * @throws BadParameterException
	 * @throws NotFoundException
	 * @throws AuthenticationException
	 */
	public function delete(Request $request) {
		$this->assumeLogged();
        $purpose = $this->purposeService->getPurpose($request->get('purpose'));
        $this->memberPurposeService->delete($this->member, $purpose);
		return Response::create(['success' => true]);
	}
}
