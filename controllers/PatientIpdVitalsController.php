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

class PatientIpdVitalsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/patientipdvitalslist[/{id}]", [PermissionMiddleware::class], "list.patient_ipd_vitals")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientIpdVitalsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/patientipdvitalsadd[/{id}]", [PermissionMiddleware::class], "add.patient_ipd_vitals")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientIpdVitalsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/patientipdvitalsview[/{id}]", [PermissionMiddleware::class], "view.patient_ipd_vitals")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientIpdVitalsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/patientipdvitalsedit[/{id}]", [PermissionMiddleware::class], "edit.patient_ipd_vitals")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientIpdVitalsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/patientipdvitalsdelete[/{id}]", [PermissionMiddleware::class], "delete.patient_ipd_vitals")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientIpdVitalsDelete");
    }
}
