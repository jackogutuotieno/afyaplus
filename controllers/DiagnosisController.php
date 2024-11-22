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

class DiagnosisController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/diagnosislist[/{id}]", [PermissionMiddleware::class], "list.diagnosis")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DiagnosisList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/diagnosisadd[/{id}]", [PermissionMiddleware::class], "add.diagnosis")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DiagnosisAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/diagnosisview[/{id}]", [PermissionMiddleware::class], "view.diagnosis")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DiagnosisView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/diagnosisedit[/{id}]", [PermissionMiddleware::class], "edit.diagnosis")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DiagnosisEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/diagnosisdelete[/{id}]", [PermissionMiddleware::class], "delete.diagnosis")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DiagnosisDelete");
    }
}
