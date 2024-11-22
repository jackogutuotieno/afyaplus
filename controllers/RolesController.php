<?php

namespace PHPMaker2024\afyaplus;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\afyaplus\Attributes\Delete;
use PHPMaker2024\afyaplus\Attributes\Get;
use PHPMaker2024\afyaplus\Attributes\Map;
use PHPMaker2024\afyaplus\Attributes\Options;
use PHPMaker2024\afyaplus\Attributes\Patch;
use PHPMaker2024\afyaplus\Attributes\Post;
use PHPMaker2024\afyaplus\Attributes\Put;

class RolesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/roleslist[/{role_id}]", [PermissionMiddleware::class], "list.roles")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RolesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/rolesadd[/{role_id}]", [PermissionMiddleware::class], "add.roles")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RolesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/rolesview[/{role_id}]", [PermissionMiddleware::class], "view.roles")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RolesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/rolesedit[/{role_id}]", [PermissionMiddleware::class], "edit.roles")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RolesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/rolesdelete[/{role_id}]", [PermissionMiddleware::class], "delete.roles")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RolesDelete");
    }
}
