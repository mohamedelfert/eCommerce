<?php

use App\Http\Controllers\Admin\UploadController;
use App\Models\Department;
use App\Models\Settings;
use Illuminate\Support\Facades\Request;

if (!function_exists('adminUrl')) {
    function adminUrl($url = null)
    {
        return url('admin/' . $url);
    }
}

if (!function_exists('admin')) {
    function admin()
    {
        return auth()->guard('admin');
    }
}

if (!function_exists('setting')) {
    function setting()
    {
        return Settings::orderBy('id', 'desc')->first();
    }
}

if (!function_exists('upload_file')) {
    function upload_file()
    {
        return new UploadController;
    }
}

if (!function_exists('active_menu')) {
    function active_menu($link)
    {
        if (preg_match('/' . $link . '/i', Request::segment(2))) {
            return ['menu-open', 'display:block'];
        } else {
            return ['', ''];
        }
    }
}

if (!function_exists('lang')) {
    function lang()
    {
        if (session()->has('lang')) {
            return session('lang');
        } else {
            session()->put('lang', setting()->main_lang);
            return setting()->main_lang;
        }
    }
}

if (!function_exists('appDirection')) {
    function appDirection()
    {
        if (session()->has('lang')) {
            if (session('lang') == 'ar') {
                return 'rtl';
            } else {
                return 'ltr';
            }
        } else {
            return 'ltr';
        }
    }
}

if (!function_exists('datatablesLang')) {
    function datatablesLang()
    {
        return [
            'sProcessing' => trans('admin.sProcessing'),
            'sLengthMenu' => trans('admin.sLengthMenu'),
            'sZeroRecords' => trans('admin.sZeroRecords'),
            'sEmptyTable' => trans('admin.sEmptyTable'),
            'sInfo' => trans('admin.sInfo'),
            'sInfoEmpty' => trans('admin.sInfoEmpty'),
            'sInfoFiltered' => trans('admin.sInfoFiltered'),
            'sInfoPostFix' => trans('admin.sInfoPostFix'),
            'sSearch' => trans('admin.sSearch'),
            'sUrl' => trans('admin.sUrl'),
            'sInfoThousands' => trans('admin.sInfoThousands'),
            'sLoadingRecords' => trans('admin.sLoadingRecords'),
            'oPaginate' => [
                'sFirst' => trans('admin.sFirst'),
                'sLast' => trans('admin.sLast'),
                'sNext' => trans('admin.sNext'),
                'sPrevious' => trans('admin.sPrevious'),
            ],
            'oAria' => [
                'sSortAscending' => trans('admin.sSortAscending'),
                'sSortDescending' => trans('admin.sSortDescending'),
            ],
        ];
    }
}

if (!function_exists('validate_image')) {
    function validate_image($exe = null)
    {
        if ($exe === null) {
            return 'image|mimes:jpeg,jpg,gif,png,bmp';
        } else {
            return 'image|mimes:' . $exe;
        }
    }
}

if (!function_exists('load_department')) {
    function load_department($select = null, $option = null)
    {
        $departments = Department::selectRaw('department_name_' . session('lang') . ' as text')
            ->selectRaw('id as id')
            ->selectRaw('parent as parent')
            ->get(['text', 'id', 'parent']);
        $department_array = [];
        foreach ($departments as $department) {
            $list_array = [];
            $list_array['icon'] = '';
            $list_array['li_attr'] = '';
            $list_array['a_attr'] = '';
            $list_array['children'] = [];
            if ($select !== null and $select == $department->id) {
                $list_array['state'] = [
                    'opened' => true,
                    'selected' => true,
                    'disabled' => false,
                    'hidden' => false,
                ];
            }
            if ($option !== null and $option == $department->id) {
                $list_array['state'] = [
                    'opened' => false,
                    'selected' => false,
                    'disabled' => true,
                    'hidden' => true,
                ];
            }
            $list_array['id'] = $department->id;
            $list_array['text'] = $department->text;
            $list_array['parent'] = $department->parent !== null ? $department->parent : '#';
            array_push($department_array, $list_array);
        }
        return json_encode($department_array, JSON_UNESCAPED_UNICODE);
    }
}

if (!function_exists('get_parent_department')) {
    function get_parent_department($dep_id)
    {
        $department = Department::find($dep_id);
        if ($department->parent !== null and $department->parent > 0) {
            return get_parent_department($department->parent) . ',' . $dep_id;
        }else{
            return $dep_id;
        }
    }
}
