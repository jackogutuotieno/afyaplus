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

class PatientIpdServicesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/patientipdserviceslist[/{id}]", [PermissionMiddleware::class], "list.patient_ipd_services")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientIpdServicesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/patientipdservicesadd[/{id}]", [PermissionMiddleware::class], "add.patient_ipd_services")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientIpdServicesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/patientipdservicesview[/{id}]", [PermissionMiddleware::class], "view.patient_ipd_services")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientIpdServicesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/patientipdservicesedit[/{id}]", [PermissionMiddleware::class], "edit.patient_ipd_services")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientIpdServicesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/patientipdservicesdelete[/{id}]", [PermissionMiddleware::class], "delete.patient_ipd_services")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientIpdServicesDelete");
    }
}
