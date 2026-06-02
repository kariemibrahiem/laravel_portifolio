<?php

namespace App\Services\Admin;

use App\Models\Portfolio as ObjModel;
use App\Services\BaseService;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

use App\Models\Collaborator;
use App\Models\Partner;
use Illuminate\Support\Str;

class ProjectService extends BaseService
{
    protected string $folder = 'content/project';
    protected string $route = 'Backprojects';

    public function __construct(ObjModel $objModel)
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
            ->editColumn('partner_id', function ($obj) {
                return $obj->partner?->name ?? "";
            })
            ->editColumn('description', function ($obj) {
                return Str::limit(strip_tags($obj->description), 50);
            })
            ->editColumn('url', function ($obj) {
                return $this->renderProjectLinks($obj);
            })
                ->addColumn('action', function ($obj) {
                    $user = Auth::guard('admin')->user();
                    $buttons = '';

                    if ($user && $user->can("projects_edit")) {
                        $buttons .= '
                                    <a href="' . route($this->route . '.edit', $obj->id) . '" 
                                    class="btn btn-sm btn-primary me-1" 
                                    title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>';
                    }

                    if ($user && $user->can("projects_delete")) {
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
                'bladeName' => trns("Projects"),
                'route' => $this->route,
            ]);
        }
    }

    public function create()
    {
        $collaborations = Collaborator::all();
        $partners = Partner::all();
        return view("{$this->folder}/partials/create", [
            'storeRoute' => route("{$this->route}.store"),
            "route" => $this->route,
            'collaborations' => $collaborations,
            'partners' => $partners,
        ]);
    }

    public function store($data)
    {
        $data = $this->normalizeLinkData($data);

        if (isset($data['image'])) {
            $data['image'] = $this->handleFile($data['image'], 'Project');
        }

        try {
            $project = $this->createData($data);
            if (isset($data['collaborator_ids'])) {
                $project->collaborators()->sync($data['collaborator_ids']);
            }
            return redirect()->route("{$this->route}.index")->with(['success' => trns('The operation was successful.')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => trns('An error occurred.') . ' ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($obj)
    {
        $collaborations = Collaborator::all();
        $partners = Partner::all();
        return view("{$this->folder}/partials/edit", [
            'obj' => $obj,
            "route" => $this->route,
            'updateRoute' => route("{$this->route}.update", (int)$obj->id),
            'collaborations' => $collaborations,
            'partners' => $partners,
        ]);
    }

    public function show($obj)
    {
        return view("{$this->folder}/partials/show", [
            'obj' => $obj,
            "route" => $this->route,
            'updateRoute' => route("{$this->route}.update", (int)$obj->id),
        ]);
    }


    public function update($data, $id)
    {
        $oldObj = $this->getById($id);
        $data = $this->normalizeLinkData($data);

        if (isset($data['image'])) {
            $data['image'] = $this->handleFile($data['image'], 'Project');

            if ($oldObj->image) {
                $this->deleteFile($oldObj->image);
            }
        }

        try {
            $oldObj->update($data);
            if (isset($data['collaborator_ids'])) {
                $oldObj->collaborators()->sync($data['collaborator_ids']);
            }
            return redirect()->route("{$this->route}.index")->with(['success' => trns('The operation was successful.')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => trns('An error occurred.') . ' ' . $e->getMessage()])->withInput();
        }
    }

    public function getDataTable(): mixed
    {
        return $this->model->orderBy('sort_order', 'asc')->get();
    }

    public function updateOrder($request)
    {
        try {
            // Case 1: Single project custom sort_order update
            if ($request->has('id') && $request->has('sort_order')) {
                $id = $request->input('id');
                $sortOrder = $request->input('sort_order');
                $this->model->where('id', $id)->update(['sort_order' => $sortOrder]);
                return response()->json(['status' => 200, 'message' => trns('updated_successfully')]);
            }

            // Case 2: Sequential bulk reordering (from drag and drop)
            $ids = $request->input('ids');
            if (is_array($ids) && count($ids)) {
                foreach ($ids as $index => $id) {
                    $this->model->where('id', $id)->update(['sort_order' => $index + 1]);
                }
                return response()->json(['status' => 200, 'message' => trns('updated_successfully')]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => trns('something_went_wrong')]);
        }
        return response()->json(['status' => 400, 'message' => trns('invalid_data')]);
    }

    protected function normalizeLinkData(array $data): array
    {
        $projectType = $data['project_type'] ?? 'website';
        $websiteUrl = $data['website_url'] ?? $data['url'] ?? null;
        $googlePlayUrl = $data['google_play_url'] ?? null;
        $appStoreUrl = $data['app_store_url'] ?? null;

        $data['project_type'] = $projectType;
        $data['website_url'] = $websiteUrl;
        $data['google_play_url'] = $googlePlayUrl;
        $data['app_store_url'] = $appStoreUrl;
        $data['url'] = $projectType === 'mobile_app'
            ? ($googlePlayUrl ?: $appStoreUrl ?: $websiteUrl)
            : $websiteUrl;

        return $data;
    }

    protected function renderProjectLinks($obj): string
    {
        $links = [];

        if ($obj->website_url ?: $obj->url) {
            $links[] = '<a href="' . e($obj->website_url ?: $obj->url) . '" target="_blank" class="btn btn-sm btn-primary">' . trns('Website') . '</a>';
        }

        if ($obj->google_play_url) {
            $links[] = '<a href="' . e($obj->google_play_url) . '" target="_blank" class="btn btn-sm btn-success">' . trns('Google Play') . '</a>';
        }

        if ($obj->app_store_url) {
            $links[] = '<a href="' . e($obj->app_store_url) . '" target="_blank" class="btn btn-sm btn-dark">' . trns('App Store') . '</a>';
        }

        if (empty($links)) {
            return '<span class="text-muted">-</span>';
        }

        return '<div class="d-flex flex-wrap gap-1">' . implode('', $links) . '</div>';
    }
}
