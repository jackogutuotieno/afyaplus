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

class PatientVisitsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/patientvisitslist[/{id}]", [PermissionMiddleware::class], "list.patient_visits")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientVisitsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/patientvisitsadd[/{id}]", [PermissionMiddleware::class], "add.patient_visits")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientVisitsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/patientvisitsview[/{id}]", [PermissionMiddleware::class], "view.patient_visits")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientVisitsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/patientvisitsedit[/{id}]", [PermissionMiddleware::class], "edit.patient_visits")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientVisitsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/patientvisitsdelete[/{id}]", [PermissionMiddleware::class], "delete.patient_visits")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientVisitsDelete");
    }

    // search
    #[Map(["GET","POST","OPTIONS"], "/patientvisitssearch", [PermissionMiddleware::class], "search.patient_visits")]
    public function search(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientVisitsSearch");
    }
}
