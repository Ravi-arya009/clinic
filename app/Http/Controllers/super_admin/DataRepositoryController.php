<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Services\DataRepositoryService;
use Illuminate\Http\Request;

class DataRepositoryController extends Controller
{
    protected $dataRepositoryService;

    public function __construct(DataRepositoryService $dataRepositoryService)
    {
        $this->dataRepositoryService = $dataRepositoryService;
    }

    public function stateIndex()
    {
        $states = $this->dataRepositoryService->getAllStates();
        return view('super_admin.state_list', compact('states'));
    }
}
