<?php

namespace App\Models\Pagination;

use Illuminate\Database\Eloquent\Model;

class Pagination extends Model
{
    //

    public function getFilter($searchVal = '', $limit = 10, $offset = 0, $orderBy = 0, $orderStyle = 'asc') {
        $orderByFields = array(
            0 => 'users.id',
            1 => 'users.firstname',
            2 => 'users.email',
            3 => 'users.primary_phone',
            4 => 'roles.role_name',
            5 => 'users.id',
            6 => 'users.id',
        );
        $data = UserModel::select('users.*', 'roles.role_name')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->whereNotIn('users.role_id', [1, 7, 8])
            ->where('users.status', 'Active')
            ->where(function($query) use ($searchVal) {
                $query->where('users.id', 'LIKE', '%' . $searchVal . '%')
                    ->orWhere('users.firstname', 'LIKE', '%' . $searchVal . '%')
                    ->orWhere('users.email', 'LIKE', '%' . $searchVal . '%')
                    ->orWhere('users.primary_phone', 'LIKE', '%' . $searchVal . '%')
                    ->orWhere('roles.role_name', 'LIKE', '%' . $searchVal . '%');
            })
            ->limit($limit)
            ->offset($offset)
            ->orderBy($orderByFields[$orderBy], $orderStyle)
            ->get();
        return $data;
    }

    public function getFilterCount($searchVal = '', $limit = 10, $offset = 0, $orderBy = 0, $orderStyle = 'asc') {
        $orderByFields = array(
            0 => 'users.id',
            1 => 'users.firstname',
            2 => 'users.email',
            3 => 'users.primary_phone',
            4 => 'roles.role_name',
            5 => 'users.id',
            6 => 'users.id',
        );
        $data = UserModel::select('users.*', 'roles.role_name')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->whereNotIn('users.role_id', [1, 7, 8])
            ->where('users.status', 'Active')
            ->where(function($query) use ($searchVal) {
                $query->where('users.id', 'LIKE', '%' . $searchVal . '%')
                    ->orWhere('users.firstname', 'LIKE', '%' . $searchVal . '%')
                    ->orWhere('users.email', 'LIKE', '%' . $searchVal . '%')
                    ->orWhere('users.primary_phone', 'LIKE', '%' . $searchVal . '%')
                    ->orWhere('roles.role_name', 'LIKE', '%' . $searchVal . '%');
            })
            ->orderBy($orderByFields[$orderBy], $orderStyle)
            ->count();
        return $data;
    }

    public function getAllCount() {
        $cont = UserModel::whereNotIn('role_id', [1, 7, 8])
            ->where('status', 'Active')
            ->get();
        return count($cont);
    }
}
