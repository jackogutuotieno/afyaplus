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

class LabTestRequestsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/labtestrequestslist[/{id}]", [PermissionMiddleware::class], "list.lab_test_requests")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabTestRequestsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/labtestrequestsadd[/{id}]", [PermissionMiddleware::class], "add.lab_test_requests")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabTestRequestsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/labtestrequestsview[/{id}]", [PermissionMiddleware::class], "view.lab_test_requests")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabTestRequestsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/labtestrequestsedit[/{id}]", [PermissionMiddleware::class], "edit.lab_test_requests")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabTestRequestsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/labtestrequestsdelete[/{id}]", [PermissionMiddleware::class], "delete.lab_test_requests")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabTestRequestsDelete");
    }
}
