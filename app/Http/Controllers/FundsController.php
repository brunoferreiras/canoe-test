<?php

namespace App\Http\Controllers;

use App\Http\Requests\FundCreateRequest;
use App\Http\Requests\FundUpdateRequest;
use App\Repositories\FundRepository;

/**
 * Class FundsController.
 *
 * @package namespace App\Http\Controllers;
 */
class FundsController extends Controller
{
    protected FundRepository $repository;

    public function __construct(FundRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FundCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function store(FundCreateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FundUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     */
    public function update(FundUpdateRequest $request, $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
