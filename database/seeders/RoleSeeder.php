<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        //Permisos de user
        Permission::create(['name' => 'user.index'])->syncRoles([$adminRole,$userRole]);
        Permission::create(['name' => 'user.create'])->syncRoles([$adminRole,$userRole]);
        Permission::create(['name' => 'user.show'])->syncRoles([$adminRole,$userRole]);
        Permission::create(['name' => 'user.edit'])->syncRoles([$adminRole,$userRole]);
        Permission::create(['name' => 'user.destroy'])->syncRoles([$adminRole,$userRole]);

        //Permisos de admin
        Permission::create(['name' => 'admin.index'])->assignRole($adminRole);
        Permission::create(['name' => 'admin.create'])->assignRole($adminRole);
        Permission::create(['name' => 'admin.edit'])->assignRole($adminRole);
        Permission::create(['name' => 'admin.destroy'])->assignRole($adminRole);

        //Permisos de ingresos
        Permission::create(['name' => 'ingreso.index'])->assignRole($userRole);
        Permission::create(['name' => 'ingreso.create'])->assignRole($userRole);
        Permission::create(['name' => 'ingreso.edit'])->assignRole($userRole);
        Permission::create(['name' => 'ingreso.destroy'])->assignRole($userRole);

         //Permisos de gastos
         Permission::create(['name' => 'gasto.index'])->assignRole($userRole);
         Permission::create(['name' => 'gasto.create'])->assignRole($userRole);
         Permission::create(['name' => 'gasto.edit'])->assignRole($userRole);
         Permission::create(['name' => 'gasto.destroy'])->assignRole($userRole);

          //Permisos de saldo
        Permission::create(['name' => 'saldo.index'])->assignRole($userRole);
        Permission::create(['name' => 'saldo.create'])->assignRole($userRole);
        Permission::create(['name' => 'saldo.edit'])->assignRole($userRole);
        Permission::create(['name' => 'saldo.destroy'])->assignRole($userRole);

        //Permisos de categoriasg para admin
        Permission::create(['name' => 'categoriasg.index'])->assignRole($adminRole);
        Permission::create(['name' => 'categoriasg.create'])->assignRole($adminRole);
        Permission::create(['name' => 'categoriasg.edit'])->assignRole($adminRole);
        Permission::create(['name' => 'categoriasg.destroy'])->assignRole($adminRole);

        //Permisos de administrar usuarios para admin
        Permission::create(['name' => 'userr.index'])->assignRole($adminRole);
        Permission::create(['name' => 'userr.create'])->assignRole($adminRole);
        Permission::create(['name' => 'userr.edit'])->assignRole($adminRole);
        Permission::create(['name' => 'userr.destroy'])->assignRole($adminRole);

        //Permisos de previo(analisis)
        Permission::create(['name' => 'previo.index'])->assignRole($userRole);
        Permission::create(['name' => 'previo.create'])->assignRole($userRole);
        Permission::create(['name' => 'previo.edit'])->assignRole($userRole);
        Permission::create(['name' => 'previo.destroy'])->assignRole($userRole);

        //Permisos de historicos(historial)
        Permission::create(['name' => 'historicos.create'])->assignRole($userRole);

        //Permisos de meta
        Permission::create(['name' => 'meta.index'])->assignRole($userRole);
        Permission::create(['name' => 'meta.create'])->assignRole($userRole);
        Permission::create(['name' => 'meta.edit'])->assignRole($userRole);
        Permission::create(['name' => 'meta.destroy'])->assignRole($userRole);

        //Permisos de meta historicos(historial)
        Permission::create(['name' => 'meta_historicos.create'])->assignRole($userRole);
        //
    }
}
