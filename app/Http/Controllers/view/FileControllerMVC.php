<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 7. 7. 2018
 * Time: 13:31
 */

namespace App\Http\Controllers;


use App\Model\Service\IFileService;
use App\Model\Service\IMemberService;
use App\Model\Service\IWalletService;
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
	 * @param IFileService $fileService
	 * @param IWalletService $walletService
	 */
	public function __construct(IMemberService $memberService, IFileService $fileService, IWalletService $walletService) {
		parent::__construct($memberService);
		$this->fileService = $fileService;
		$this->walletService = $walletService;
	}

	/**
	 * @return mixed
	 * @throws \App\Model\Exception\AuthenticationMVCException
	 * @throws \App\Model\Exception\BadParameterException
	 * @throws \App\Model\Exception\NotFoundException
	 * @throws \App\Model\Exception\UnderEntityNotFoundException
	 */
	public function backup() {
		$this->assumeLogged();
		$wallets = $this->walletService->getWallets($this->member->getLogin());
		$wallets = $this->walletService->formatEntities($wallets);
		$file = $this->fileService->getBackup($this->member);
		return view('pages.home')
			->with('wallets', $wallets)
			->with('currency', $this->member->getCurrency()->getValue())
			->with('backupFile', $file);
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|View
	 * @throws \App\Model\Exception\AuthenticationMVCException
	 */
	public function wantStore() {
		$this->assumeLogged();
		return view('pages.loadData');
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|View
	 * @throws \App\Model\Exception\AuthenticationMVCException
	 */
	public function store() {
		$this->assumeLogged();
		$member = $this->loggedMember();
		$file = Input::file('file');
		$content = File::get($file->getRealPath());
		try {
			$this->fileService->storeBackup($member, $content);
		} catch (\Exception $ex) {
			return view('pages.loadData')
				->with('err', $ex->getMessage());
		}
		return view('pages.loadData')
			->with('message', 'ok');
	}
}