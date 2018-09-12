<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 7. 7. 2018
 * Time: 13:31
 */

namespace App\Http\Controllers;


use App\Model\Exception\ApplicationException;
use App\Model\Exception\AuthenticationMVCException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\IFileService;
use App\Model\Service\IMemberService;
use App\Model\Service\ITranslationService;
use App\Model\Service\IWalletService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\View\View;

class FileControllerMVC extends AbstractControllerMVC
{
	/** @var IFileService */
	protected $fileService;
	/** @var IWalletService */
	protected $walletService;

    /**
     * FileControllerMVC constructor.
     * @param IMemberService $memberService
     * @param ITranslationService $translationService
     * @param IFileService $fileService
     * @param IWalletService $walletService
     */
	public function __construct(IMemberService $memberService, ITranslationService $translationService, IFileService $fileService, IWalletService $walletService) {
		parent::__construct($memberService, $translationService);
		$this->fileService = $fileService;
		$this->walletService = $walletService;
	}

	/**
	 * @return mixed
	 * @throws AuthenticationMVCException
	 */
	public function backup() {
		$this->assumeLogged();
		$file = $this->fileService->getBackup($this->member);
		return Response::create($file, Response::HTTP_OK)->header('Content-Type', 'attachment/csv');
	}

	/**
	 * @return View
	 * @throws AuthenticationMVCException
     * @throws NotFoundException
     * @throws BadParameterException
	 */
	public function store() {
		$this->assumeLogged();

		//only form to upload
		if (Input::file('file') === null) {
            return view('pages.loadBackup');
        }

		$file = Input::file('file');
		$content = File::get($file->getRealPath());
		try {
			$this->fileService->storeBackup($this->member, $content);
		} catch (ApplicationException $ex) {
		    $message = $this->trans->get($ex->getMessage(), $ex->getDefault());
			return view('pages.loadBackup')
				->with('err', $ex->bind($message));
		}
		return view('pages.loadBackup')
			->with('message', 'ok');
	}
}
