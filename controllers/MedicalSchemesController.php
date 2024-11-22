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

class MedicalSchemesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/medicalschemeslist[/{id}]", [PermissionMiddleware::class], "list.medical_schemes")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicalSchemesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/medicalschemesadd[/{id}]", [PermissionMiddleware::class], "add.medical_schemes")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicalSchemesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/medicalschemesview[/{id}]", [PermissionMiddleware::class], "view.medical_schemes")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicalSchemesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/medicalschemesedit[/{id}]", [PermissionMiddleware::class], "edit.medical_schemes")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicalSchemesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/medicalschemesdelete[/{id}]", [PermissionMiddleware::class], "delete.medical_schemes")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicalSchemesDelete");
    }
}
