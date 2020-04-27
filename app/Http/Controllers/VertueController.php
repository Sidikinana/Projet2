<?php

namespace App\Http\Controllers;

use App\DataTables\VertueDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateVertueRequest;
use App\Http\Requests\UpdateVertueRequest;
use App\Repositories\VertueRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class VertueController extends AppBaseController
{
    /** @var  VertueRepository */
    private $vertueRepository;

    public function __construct(VertueRepository $vertueRepo)
    {
        $this->vertueRepository = $vertueRepo;
    }

    /**
     * Display a listing of the Vertue.
     *
     * @param VertueDataTable $vertueDataTable
     * @return Response
     */
    public function index(VertueDataTable $vertueDataTable)
    {
        return $vertueDataTable->render('vertues.index');
    }

    /**
     * Show the form for creating a new Vertue.
     *
     * @return Response
     */
    public function create()
    {
		
        return view('vertues.create');
    }

    /**
     * Store a newly created Vertue in storage.
     *
     * @param CreateVertueRequest $request
     *
     * @return Response
     */
    public function store(CreateVertueRequest $request)
    {
        $input = $request->all();

        $vertue = $this->vertueRepository->create($input);

        Flash::success('Vertue saved successfully.');

        return redirect(route('vertues.index'));
    }

    /**
     * Display the specified Vertue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vertue = $this->vertueRepository->find($id);

        if (empty($vertue)) {
            Flash::error('Vertue not found');

            return redirect(route('vertues.index'));
        }

        return view('vertues.show')->with('vertue', $vertue);
    }

    /**
     * Show the form for editing the specified Vertue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $vertue = $this->vertueRepository->find($id);

        if (empty($vertue)) {
            Flash::error('Vertue not found');

            return redirect(route('vertues.index'));
        }

        return view('vertues.edit')->with('vertue', $vertue);
    }

    /**
     * Update the specified Vertue in storage.
     *
     * @param  int              $id
     * @param UpdateVertueRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVertueRequest $request)
    {
        $vertue = $this->vertueRepository->find($id);

        if (empty($vertue)) {
            Flash::error('Vertue not found');

            return redirect(route('vertues.index'));
        }

        $vertue = $this->vertueRepository->update($request->all(), $id);

        Flash::success('Vertue updated successfully.');

        return redirect(route('vertues.index'));
    }

    /**
     * Remove the specified Vertue from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $vertue = $this->vertueRepository->find($id);

        if (empty($vertue)) {
            Flash::error('Vertue not found');

            return redirect(route('vertues.index'));
        }

        $this->vertueRepository->delete($id);

        Flash::success('Vertue deleted successfully.');

        return redirect(route('vertues.index'));
    }
}
