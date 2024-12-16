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

class UrinalysisReportController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/urinalysisreportlist[/{id}]", [PermissionMiddleware::class], "list.urinalysis_report")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UrinalysisReportList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/urinalysisreportadd[/{id}]", [PermissionMiddleware::class], "add.urinalysis_report")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UrinalysisReportAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/urinalysisreportview[/{id}]", [PermissionMiddleware::class], "view.urinalysis_report")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UrinalysisReportView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/urinalysisreportedit[/{id}]", [PermissionMiddleware::class], "edit.urinalysis_report")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UrinalysisReportEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/urinalysisreportdelete[/{id}]", [PermissionMiddleware::class], "delete.urinalysis_report")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UrinalysisReportDelete");
    }
}
