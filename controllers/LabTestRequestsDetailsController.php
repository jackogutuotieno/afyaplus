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

class LabTestRequestsDetailsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/labtestrequestsdetailslist[/{id}]", [PermissionMiddleware::class], "list.lab_test_requests_details")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabTestRequestsDetailsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/labtestrequestsdetailsadd[/{id}]", [PermissionMiddleware::class], "add.lab_test_requests_details")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabTestRequestsDetailsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/labtestrequestsdetailsview[/{id}]", [PermissionMiddleware::class], "view.lab_test_requests_details")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabTestRequestsDetailsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/labtestrequestsdetailsedit[/{id}]", [PermissionMiddleware::class], "edit.lab_test_requests_details")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabTestRequestsDetailsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/labtestrequestsdetailsdelete[/{id}]", [PermissionMiddleware::class], "delete.lab_test_requests_details")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabTestRequestsDetailsDelete");
    }
}
