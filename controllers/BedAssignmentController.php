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

class BedAssignmentController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/bedassignmentlist[/{id}]", [PermissionMiddleware::class], "list.bed_assignment")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BedAssignmentList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/bedassignmentadd[/{id}]", [PermissionMiddleware::class], "add.bed_assignment")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BedAssignmentAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/bedassignmentview[/{id}]", [PermissionMiddleware::class], "view.bed_assignment")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BedAssignmentView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/bedassignmentedit[/{id}]", [PermissionMiddleware::class], "edit.bed_assignment")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BedAssignmentEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/bedassignmentdelete[/{id}]", [PermissionMiddleware::class], "delete.bed_assignment")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BedAssignmentDelete");
    }
}
