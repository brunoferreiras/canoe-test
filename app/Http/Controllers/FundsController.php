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
        return $this->repository->with('manager')->paginate();
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
        try {
            $fund = $this->repository->create($request->all());
            return response()->json($fund, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            $fund = $this->repository->with(['manager', 'companies'])->find($id);
            return response()->json($fund, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
        try {
            $fund = $this->repository->update($request->all(), $id);
            return response()->json($fund, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
        try {
            $this->repository->delete($id);
            return response()->json([], 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
