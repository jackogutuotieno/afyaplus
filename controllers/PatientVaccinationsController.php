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

class PatientVaccinationsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/patientvaccinationslist[/{id}]", [PermissionMiddleware::class], "list.patient_vaccinations")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientVaccinationsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/patientvaccinationsadd[/{id}]", [PermissionMiddleware::class], "add.patient_vaccinations")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientVaccinationsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/patientvaccinationsview[/{id}]", [PermissionMiddleware::class], "view.patient_vaccinations")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientVaccinationsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/patientvaccinationsedit[/{id}]", [PermissionMiddleware::class], "edit.patient_vaccinations")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientVaccinationsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/patientvaccinationsdelete[/{id}]", [PermissionMiddleware::class], "delete.patient_vaccinations")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientVaccinationsDelete");
    }
}
