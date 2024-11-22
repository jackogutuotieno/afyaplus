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

class PatientVitalsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/patientvitalslist[/{id}]", [PermissionMiddleware::class], "list.patient_vitals")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientVitalsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/patientvitalsadd[/{id}]", [PermissionMiddleware::class], "add.patient_vitals")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientVitalsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/patientvitalsview[/{id}]", [PermissionMiddleware::class], "view.patient_vitals")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientVitalsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/patientvitalsedit[/{id}]", [PermissionMiddleware::class], "edit.patient_vitals")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientVitalsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/patientvitalsdelete[/{id}]", [PermissionMiddleware::class], "delete.patient_vitals")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientVitalsDelete");
    }
}
