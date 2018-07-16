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
use Illuminate\Support\Facades\Auth;
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

	public function backup() {
		$this->assumeLogged();
		$member = Auth::user();
		$wallets = $this->walletService->getWallets($member->getLogin());
		$wallets = $this->walletService->formatEntities($wallets);
		$file = $this->fileService->getBackup(Auth::user());
		return view('pages.home')
			->with('wallets', $wallets)
			->with('currency', Auth::user()->getCurrency()->getValue())
			->with('backupFile', $file);
	}

	public function wantStore() {
		$this->assumeLogged();
		return view('pages.loadData');
	}

	/**
	 * @return View
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