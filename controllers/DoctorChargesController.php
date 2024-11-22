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

class DoctorChargesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/doctorchargeslist[/{id}]", [PermissionMiddleware::class], "list.doctor_charges")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DoctorChargesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/doctorchargesadd[/{id}]", [PermissionMiddleware::class], "add.doctor_charges")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DoctorChargesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/doctorchargesview[/{id}]", [PermissionMiddleware::class], "view.doctor_charges")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DoctorChargesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/doctorchargesedit[/{id}]", [PermissionMiddleware::class], "edit.doctor_charges")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DoctorChargesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/doctorchargesdelete[/{id}]", [PermissionMiddleware::class], "delete.doctor_charges")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DoctorChargesDelete");
    }
}
