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

class PatientsDependantsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/patientsdependantslist[/{id}]", [PermissionMiddleware::class], "list.patients_dependants")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientsDependantsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/patientsdependantsadd[/{id}]", [PermissionMiddleware::class], "add.patients_dependants")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientsDependantsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/patientsdependantsview[/{id}]", [PermissionMiddleware::class], "view.patients_dependants")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientsDependantsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/patientsdependantsedit[/{id}]", [PermissionMiddleware::class], "edit.patients_dependants")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientsDependantsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/patientsdependantsdelete[/{id}]", [PermissionMiddleware::class], "delete.patients_dependants")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientsDependantsDelete");
    }
}
