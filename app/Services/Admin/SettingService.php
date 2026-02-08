<?php

namespace App\Services\Admin;

use App\Models\Setting as ObjModel;
use App\Services\BaseService;

class SettingService extends BaseService
{
    protected string $folder = 'content/setting';
    protected string $route = 'settings';

    public function __construct(ObjModel $objModel)
    {
        parent::__construct($objModel);
    }

    public function index($request)
    {
        // جلب أو إنشاء الإعدادات الأساسية
        $siteName = ObjModel::firstOrCreate(
            ['key' => 'site_name'],
            ['value' => 'My Website']
        );

        $logo = ObjModel::firstOrCreate(
            ['key' => 'logo'],
            ['value' => '']
        );

        return view("{$this->folder}.index", [
            'siteName' => $siteName,
            'logo' => $logo,
            'route' => $this->route,
            'updateRoute' => route("{$this->route}.update", 1), // رقم عشوائي لأننا مش بنستخدم الـ id فعلاً
        ]);
    }

    public function update($data, $id)
    {
        try {
            // تحديث أو إنشاء اسم الموقع
            if (isset($data['name'])) {
                ObjModel::updateOrCreate(
                    ['key' => 'site_name'],
                    ['value' => $data['name']]
                );
            }

            // تحديث أو إنشاء اللوجو
            if (isset($data['logo'])) {
                $logoPath = $this->handleFile($data['logo'], 'settings');
                ObjModel::updateOrCreate(
                    ['key' => 'logo'],
                    ['value' => $logoPath]
                );
            }

            return redirect()->route("{$this->route}.index")
                ->with(['success' => trns('Settings updated successfully.')]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => trns('An error occurred: ') . $e->getMessage()])
                ->withInput();
        }
    }
}