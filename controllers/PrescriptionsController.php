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

class PrescriptionsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/prescriptionslist[/{id}]", [PermissionMiddleware::class], "list.prescriptions")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PrescriptionsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/prescriptionsadd[/{id}]", [PermissionMiddleware::class], "add.prescriptions")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PrescriptionsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/prescriptionsview[/{id}]", [PermissionMiddleware::class], "view.prescriptions")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PrescriptionsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/prescriptionsedit[/{id}]", [PermissionMiddleware::class], "edit.prescriptions")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PrescriptionsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/prescriptionsdelete[/{id}]", [PermissionMiddleware::class], "delete.prescriptions")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PrescriptionsDelete");
    }
}
