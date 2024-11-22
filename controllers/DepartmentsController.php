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

class DepartmentsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/departmentslist[/{id}]", [PermissionMiddleware::class], "list.departments")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DepartmentsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/departmentsadd[/{id}]", [PermissionMiddleware::class], "add.departments")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DepartmentsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/departmentsview[/{id}]", [PermissionMiddleware::class], "view.departments")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DepartmentsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/departmentsedit[/{id}]", [PermissionMiddleware::class], "edit.departments")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DepartmentsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/departmentsdelete[/{id}]", [PermissionMiddleware::class], "delete.departments")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DepartmentsDelete");
    }
}
