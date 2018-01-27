<?php

namespace App\Http\Controllers;

use App\Model\Service\IItemService;
use App\Model\Service\IWalletService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemController extends Controller
{
	protected $walletService;
	protected $itemService;

	public function __construct(IWalletService $walletService, IItemService $itemService) {
		$this->walletService = $walletService;
		$this->itemService = $itemService;
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getWalletItems($id)
    {
    	$body = $this->itemService->getWalletItems($id);
        return Response::create($body, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createItem(Request $request)
    {
    	$data = json_decode($request->getContent(), true);
        return Response::create($data, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete()
    {
    	$body = [
    		'text' => 'ok'
		];
        return Response::create($body, Response::HTTP_OK);
    }
}
