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

class PatientsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/patientslist[/{id}]", [PermissionMiddleware::class], "list.patients")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/patientsadd[/{id}]", [PermissionMiddleware::class], "add.patients")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/patientsview[/{id}]", [PermissionMiddleware::class], "view.patients")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/patientsedit[/{id}]", [PermissionMiddleware::class], "edit.patients")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/patientsdelete[/{id}]", [PermissionMiddleware::class], "delete.patients")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientsDelete");
    }
}
