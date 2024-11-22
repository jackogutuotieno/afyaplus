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

class VisitTypesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/visittypeslist[/{id}]", [PermissionMiddleware::class], "list.visit_types")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "VisitTypesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/visittypesadd[/{id}]", [PermissionMiddleware::class], "add.visit_types")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "VisitTypesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/visittypesview[/{id}]", [PermissionMiddleware::class], "view.visit_types")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "VisitTypesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/visittypesedit[/{id}]", [PermissionMiddleware::class], "edit.visit_types")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "VisitTypesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/visittypesdelete[/{id}]", [PermissionMiddleware::class], "delete.visit_types")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "VisitTypesDelete");
    }
}
