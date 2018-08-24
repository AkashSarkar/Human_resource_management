<?php

namespace App\Models;

use App\Models\Boot\BModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityHistory;

class BaseModel extends BModel
{
    protected $module_name = "";
    protected $action_create = "created";
    protected $action_update = "updated";
    protected $action_delete = "deleted";
    protected $act_create = "created";
    protected $act_update = "updated";
    protected $act_delete = "deleted";
    protected $act_deleted_by = False;
    protected $activity_log = True;
    protected $activity_log_create = True;
    protected $activity_log_update = True;
    protected $activity_log_delete = True;

    protected static function boot()
    {
        parent::boot(); /* * During a model create Eloquent will also update the updated_at field so * need to have the updated_by field here as well * */
        static::created(function ($model) {
            if (Auth::user()) {
                $model->created_by = Auth::user()->id;
//                $model->updated_by = Auth::user()->id;

                if ($model->activity_log && $model->activity_log_create) {
                    ActivityHistory::log($model->module_name, $model->action_create, $model->act_create, $model->id, [], $model->set_act_create_desc());
                }
            } else {
                $model->created_by = UserModel::inRandomOrder()->first()->id;
                $model->updated_by = UserModel::inRandomOrder()->first()->id;

                if ($model->activity_log && $model->activity_log_create) {
                    ActivityHistory::fakelog($model->created_by, $model->module_name, $model->action_create, $model->act_create, $model->id, [], $model->set_act_create_desc());
                }
            }
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::user()->id;
            if ($model->activity_log && $model->activity_log_update) {
                ActivityHistory::log($model->module_name, $model->action_update, $model->act_update, $model->id, ActivityHistory::getProperty($model), $model->set_act_update_desc());
            }
        });

        static::deleting(function ($model) {
            if ($model->act_deleted_by) {
                $model->deleted_by = Auth::user()->id;
                $model->save();
            }
            if ($model->activity_log && $model->activity_log_delete) {
                ActivityHistory::log($model->module_name, $model->action_delete, $model->act_delete, $model->id, [], $model->set_act_delete_desc());
            }
        });

    }

    protected function set_act_create_desc()
    {
        return "{causer} created " . $this->module_name;
    }

    protected function set_act_update_desc()
    {
        return "{causer} updated " . $this->module_name;
    }

    protected function set_act_delete_desc()
    {
        return "{causer} deleted " . $this->module_name;
    }


    public function set_action_create($action_type)
    {
        $this->action_create = $action_type;
    }

    public function set_action_update($action_type)
    {
        $this->action_update = $action_type;
    }

    public function set_action_delete($action_type)
    {
        $this->action_delete = $action_type;
    }

    public function set_act_create($action_type)
    {
        $this->act_create = $action_type;
    }

    public function set_act_update($action_type)
    {
        $this->act_update = $action_type;
    }

    public function set_act_delete($action_type)
    {
        $this->act_delete = $action_type;
    }
}
