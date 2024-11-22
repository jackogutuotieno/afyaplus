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

class UsersController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/userslist[/{id}]", [PermissionMiddleware::class], "list.users")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UsersList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/usersadd[/{id}]", [PermissionMiddleware::class], "add.users")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UsersAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/usersview[/{id}]", [PermissionMiddleware::class], "view.users")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UsersView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/usersedit[/{id}]", [PermissionMiddleware::class], "edit.users")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UsersEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/usersdelete[/{id}]", [PermissionMiddleware::class], "delete.users")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UsersDelete");
    }
}
