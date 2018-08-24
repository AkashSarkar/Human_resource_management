<?php

use Illuminate\Database\Seeder;

class AccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = DB::table('modules')->select("id")->get();
        $roles = DB::table('roles')->select("id")->whereNotIn("id", [7, 8])->get();
        $data = [];
        foreach ($roles as $role) {
            $perm = 0;
            if (in_array($role->id, [1])) {
                $perm = 1;
            }
            $perm = 1;
            foreach ($modules as $module) {
                $data[] = [
                    'perm_role_id' => $role->id,
                    'perm_module_id' => $module->id,
                    'perm_view' => $perm,
                    'perm_add' => $perm,
                    'perm_edit' => $perm,
                    'perm_delete' => $perm,
                    'perm_all' => $perm
                ];
            }
        }
        DB::table('access')->insert($data);

    }
}
