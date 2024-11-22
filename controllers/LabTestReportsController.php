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

class LabTestReportsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/labtestreportslist[/{id}]", [PermissionMiddleware::class], "list.lab_test_reports")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabTestReportsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/labtestreportsadd[/{id}]", [PermissionMiddleware::class], "add.lab_test_reports")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabTestReportsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/labtestreportsview[/{id}]", [PermissionMiddleware::class], "view.lab_test_reports")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabTestReportsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/labtestreportsedit[/{id}]", [PermissionMiddleware::class], "edit.lab_test_reports")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabTestReportsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/labtestreportsdelete[/{id}]", [PermissionMiddleware::class], "delete.lab_test_reports")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabTestReportsDelete");
    }
}
