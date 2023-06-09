<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin rôle
        $adminRole = Role::create(['name' => 'admin']);

        // App Roles
        $directeurRole = Role::create(['name' => 'directeur']);
        $chefRole = Role::create(['name' => 'chef']);
        $magasinierRole = Role::create(['name' => 'magasinier']);

        // List of all permissions
        $adminPermissions = [
            "voir_articles",
            "fiche_articles",

            "voir_sorties",
            "cree_sorties",
            "modifier_sorties",
            "supprimer_sorties",

            "voir_fournisseurs",
            "cree_fournisseurs",
            "modifier_fournisseurs",
            "supprimer_fournisseurs",

            "voir_receptions",
            "cree_receptions",
            "modifier_receptions",
            "supprimer_receptions",

            "voir_inventaires",
            "cree_inventaires",
            "modifier_inventaires",
            "supprimer_inventaires",

            "voir_commandes",
            "cree_commandes",
            "modifier_commandes",
            "supprimer_commandes",

            "voir_reformes",
            "cree_reformes",
            "modifier_reformes",
            "supprimer_reformes",

        ];

        // directeur permissions
        $directeurPermissions = [
            "voir_articles",
            "fiche_articles",

            "voir_sorties",

            "voir_fournisseurs",
            "cree_fournisseurs",
            "modifier_fournisseurs",
            "supprimer_fournisseurs",

            "voir_receptions",

            "voir_inventaires",

            "voir_commandes",
            "cree_commandes",
            "modifier_commandes",
            "supprimer_commandes",

            "voir_reformes",

        ];

        // chef permissions
        $chefPermissions = [
            "voir_articles",
            "fiche_articles",

            "voir_sorties",
            "cree_sorties",
            "modifier_sorties",
            "supprimer_sorties",

            "voir_fournisseurs",

            "voir_receptions",
            "cree_receptions",
            "modifier_receptions",
            "supprimer_receptions",

            "voir_inventaires",
            "cree_inventaires",
            "modifier_inventaires",
            "supprimer_inventaires",

            "voir_commandes",

            "voir_reformes",
            "cree_reformes",
            "modifier_reformes",
            "supprimer_reformes",

        ];

        // magasinier permissions
        $magasinierPermissions = [
            "voir_articles",
            "fiche_articles",

            "voir_sorties",
            "cree_sorties",
            "modifier_sorties",
            "supprimer_sorties",

            "voir_fournisseurs",

            "voir_inventaires",

            "voir_commandes",

            "voir_reformes",
        ];

        // create & assign permission to the admin
        foreach ($adminPermissions as $permission) {
            Permission::create([
                "name" => $permission
            ]);
            $adminRole->givePermissionTo($permission);
        };

        // assign permission to the directeur
        foreach ($directeurPermissions as $permission) {
            $directeurRole->givePermissionTo($permission);
        };

        // assign chef to the directeur
        foreach ($chefPermissions as $permission) {
            $chefRole->givePermissionTo($permission);
        };

        // assign chef to the directeur
        foreach ($magasinierPermissions as $permission) {
            $magasinierRole->givePermissionTo($permission);
        };


    }
}
