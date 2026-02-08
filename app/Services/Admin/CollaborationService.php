<?php

namespace App\Services\Admin;

use App\Models\Collaborator as ObjModel;
use App\Models\Collaborator;
use App\Services\BaseService;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class CollaborationService extends BaseService
{
    protected string $folder = 'content/collaboration';
    protected string $route = 'collaborations';

    public function __construct(ObjModel $objModel, protected Collaborator $collaborations)
    {
        parent::__construct($objModel);
    }

    public function index($request)
    {
        if ($request->ajax()) {
            $obj = $this->getDataTable();
            return DataTables::of($obj)
                ->editColumn('image', function ($obj) {
                    return $this->imageDataTable($obj->image);
                })
                ->addColumn('action', function ($obj) {
                    $user = Auth::guard('admin')->user();
                    $buttons = '';

                    if ($user && $user->can("collaborations_edit")) {
                        $buttons .= '
                                    <a href="' . route($this->route . '.edit', $obj->id) . '" 
                                    class="btn btn-sm btn-primary me-1" 
                                    title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>';
                    }

                    if ($user && $user->can("collaborations_delete")) {
                        $buttons .= '
                                    <button type="button" 
                                            class="btn btn-sm btn-danger delete-confirm" 
                                            data-url="' . route($this->route . '.destroy', $obj->id) . '" 
                                            title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>';
                    }

                    return $buttons;
                })
                ->addIndexColumn()
                ->escapeColumns([])
                ->make(true);
        } else {
            return view($this->folder . '/index', [
                'createRoute' => route($this->route . '.create'),
                'bladeName' => "",
                'route' => $this->route,
            ]);
        }
    }

    public function create()
    {
        return view("{$this->folder}/partials/create", [
            'storeRoute' => route("{$this->route}.store"),
            "route" => $this->route,
            "collaborations" => $this->collaborations->get()
        ]);
    }

    public function store($data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->handleFile($data['image'], 'Collaboration');
        }

        $collaboration_ids = $data['collaboration_ids'] ?? [];
        unset($data['collaboration_ids']);
        try {
            $obj = $this->createData($data);
            $obj->collaborators()->attach($collaboration_ids);
            return redirect()->route("{$this->route}.index")->with(['success' => trns('The operation was successful.')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => trns('An error occurred.') . ' ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($obj)
    {
        return view("{$this->folder}/partials/edit", [
            'obj' => $obj,
            "route" => $this->route,
            'updateRoute' => route("{$this->route}.update", (int)$obj->id),
            "collaborations" => $this->collaborations->get()
        ]);
    }

    public function update($data, $id)
    {
        $oldObj = $this->getById($id);

        if (isset($data['image'])) {
            $data['image'] = $this->handleFile($data['image'], 'Collaboration');

            if ($oldObj->image) {
                $this->deleteFile($oldObj->image);
            }
        }

        $collaboration_ids = $data['collaboration_ids'] ?? [];
        unset($data['collaboration_ids']);
        try {
            $oldObj->update($data);

            $oldObj->collaborators()->sync($collaboration_ids);
            return redirect()->route("{$this->route}.index")->with(['success' => trns('The operation was successful.')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => trns('An error occurred.') . ' ' . $e->getMessage()])->withInput();
        }
    }
}
