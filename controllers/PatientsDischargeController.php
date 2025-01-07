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

class PatientsDischargeController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/patientsdischargelist[/{id}]", [PermissionMiddleware::class], "list.patients_discharge")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientsDischargeList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/patientsdischargeadd[/{id}]", [PermissionMiddleware::class], "add.patients_discharge")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientsDischargeAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/patientsdischargeview[/{id}]", [PermissionMiddleware::class], "view.patients_discharge")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientsDischargeView");
    }
}
