<?php

namespace App\Http\Controllers;


use App\Models\AccessModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{

    public $queries;

    public function __construct()
    {
        DB::connection()->enableQueryLog();
        DB::connection('pgsql_front')->enableQueryLog();
        $this->perm();
        $this->side_menu();
//       $queries = DB::getQueryLog();
    }

    protected function resp($response, $statusCode)
    {
        if ($statusCode >= 200 && $statusCode < 300) {
            return $this->makeRespone($response, $statusCode);
        } else {
            return $this->makeErrorResponse($response['message'], $statusCode);
        }

    }

    protected function makeRespone($data, $statusCode)
    {
        return makeRespone($data, $statusCode);
    }

    protected function makeErrorResponse($errorMessage, $errorCode)
    {

        return makeErrorResponse($errorMessage, $errorCode);
    }


    /**
     * @author  Kazi Jamil
     */
    protected function perm()
    {
        $access = AccessModel::perm_route();
        $app = app();
        $routes = $app->routes->getRoutes();
        $perm_uri = [];
        foreach ($routes as $route) {
            $middleware = $route->middleware();
            $array_role_middleware = array_filter($middleware, function ($v) {
                return substr($v, 0, 4) === 'role';
            });
            if (count($array_role_middleware) === 1) {
                list($role, $action_list) = explode(":", reset($array_role_middleware));
                list($module, $action) = explode(",", $action_list);
                $perm_uri[$route->getName()] = $access[$module][$action];
            }
        }
        View::share('perm_uri', $perm_uri);
        View::share('permObj', $access);
    }

    /**
     * @author  Kazi Jamil
     */
    protected function side_menu()
    {
        $menus_admin = DB::table("menus")->orderBy('_sort', 'asc')->get();

        $ap_menu = [];
        foreach ($menus_admin as $menu_admin) {
            if (!$menu_admin->_parent_id) {
                // This page has no parent
                $ap_menu[$menu_admin->id]['id'] = $menu_admin->id;
                $ap_menu[$menu_admin->id]['uri_name'] = $menu_admin->uri_name;
                $ap_menu[$menu_admin->id]['url'] = $menu_admin->url;
                $ap_menu[$menu_admin->id]['label'] = $menu_admin->label;
                $ap_menu[$menu_admin->id]['_parent_id'] = $menu_admin->_parent_id;

                if (url()->current() === url($menu_admin->url)) {
                    $ap_menu[$menu_admin->id]['selected'] = true;
                    $ap_menu[$menu_admin->id]['expanded'] = true;
                }

            } else {
                // This is a child page
                $cat = [];
                $cat['id'] = $menu_admin->id;
                $cat['uri_name'] = $menu_admin->uri_name;
                $cat['url'] = $menu_admin->url;
                $cat['label'] = $menu_admin->label;
                $cat['_parent_id'] = $menu_admin->_parent_id;
                if (url()->current() === url($menu_admin->url)) {
                    $cat['selected'] = true;
                    $cat['expanded'] = true;
                }
                $subarray[$menu_admin->_parent_id][] = $cat;

            }
        }
        foreach ($ap_menu as $arr) {
            list($ap_menu[$arr['id']]['children'], $expanded) = $this->buildCategory($arr['id'], $subarray);
            if ($expanded) {
                $ap_menu[$arr['id']]['expanded'] = True;
            }
        }

        View::share('ap_menu', $ap_menu);
    }

    /**
     * @author  Kazi Jamil
     */
    protected function buildCategory($parent, $category)
    {
        $array = [];
        $expand = False;
        if (isset($category[$parent])) {
            foreach ($category[$parent] as $cat) {
                if (isset($category[$cat['_parent_id']])) {
                    list($cat["children"], $expanded) = $this->buildCategory($cat['id'], $category);
                    if ($expanded) {
                        $expand = True;
                        $cat['expanded'] = True;
                    }
                }
                if (isset($cat['selected']) && $cat['selected']) {
                    $expand = True;
                }
                $array[$cat['id']] = $cat;

            }
        }
        return [$array, $expand];
    }


}