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

class RadiologyReportsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/radiologyreportslist[/{id}]", [PermissionMiddleware::class], "list.radiology_reports")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyReportsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/radiologyreportsadd[/{id}]", [PermissionMiddleware::class], "add.radiology_reports")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyReportsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/radiologyreportsview[/{id}]", [PermissionMiddleware::class], "view.radiology_reports")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyReportsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/radiologyreportsedit[/{id}]", [PermissionMiddleware::class], "edit.radiology_reports")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyReportsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/radiologyreportsdelete[/{id}]", [PermissionMiddleware::class], "delete.radiology_reports")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyReportsDelete");
    }
}
