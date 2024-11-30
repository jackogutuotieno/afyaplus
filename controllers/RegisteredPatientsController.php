<?php

namespace PHPMaker2024\afyaplus;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\afyaplus\Attributes\Delete;
use PHPMaker2024\afyaplus\Attributes\Get;
use PHPMaker2024\afyaplus\Attributes\Map;
use PHPMaker2024\afyaplus\Attributes\Options;
use PHPMaker2024\afyaplus\Attributes\Patch;
use PHPMaker2024\afyaplus\Attributes\Post;
use PHPMaker2024\afyaplus\Attributes\Put;

/**
 * Registered_Patients controller
 */
class RegisteredPatientsController extends ControllerBase
{
    // summary
    #[Map(["GET", "POST", "OPTIONS"], "/registeredpatients", [PermissionMiddleware::class], "summary.Registered_Patients")]
    public function summary(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RegisteredPatientsSummary");
    }

    // RegisteredPatientsbyMonth (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/registeredpatients/RegisteredPatientsbyMonth", [PermissionMiddleware::class], "summary.Registered_Patients.RegisteredPatientsbyMonth")]
    public function RegisteredPatientsbyMonth(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "RegisteredPatientsSummary", "RegisteredPatientsbyMonth");
    }
}
