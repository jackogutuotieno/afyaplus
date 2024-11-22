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

class DesignationsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/designationslist[/{id}]", [PermissionMiddleware::class], "list.designations")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DesignationsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/designationsadd[/{id}]", [PermissionMiddleware::class], "add.designations")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DesignationsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/designationsview[/{id}]", [PermissionMiddleware::class], "view.designations")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DesignationsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/designationsedit[/{id}]", [PermissionMiddleware::class], "edit.designations")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DesignationsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/designationsdelete[/{id}]", [PermissionMiddleware::class], "delete.designations")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DesignationsDelete");
    }
}
