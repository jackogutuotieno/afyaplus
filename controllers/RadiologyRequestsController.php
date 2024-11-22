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

class RadiologyRequestsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/radiologyrequestslist[/{id}]", [PermissionMiddleware::class], "list.radiology_requests")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyRequestsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/radiologyrequestsadd[/{id}]", [PermissionMiddleware::class], "add.radiology_requests")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyRequestsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/radiologyrequestsview[/{id}]", [PermissionMiddleware::class], "view.radiology_requests")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyRequestsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/radiologyrequestsedit[/{id}]", [PermissionMiddleware::class], "edit.radiology_requests")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyRequestsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/radiologyrequestsdelete[/{id}]", [PermissionMiddleware::class], "delete.radiology_requests")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyRequestsDelete");
    }
}
