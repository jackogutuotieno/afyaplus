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

class RadiologyRequestsDetailsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/radiologyrequestsdetailslist[/{id}]", [PermissionMiddleware::class], "list.radiology_requests_details")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyRequestsDetailsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/radiologyrequestsdetailsadd[/{id}]", [PermissionMiddleware::class], "add.radiology_requests_details")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyRequestsDetailsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/radiologyrequestsdetailsview[/{id}]", [PermissionMiddleware::class], "view.radiology_requests_details")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyRequestsDetailsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/radiologyrequestsdetailsedit[/{id}]", [PermissionMiddleware::class], "edit.radiology_requests_details")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyRequestsDetailsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/radiologyrequestsdetailsdelete[/{id}]", [PermissionMiddleware::class], "delete.radiology_requests_details")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyRequestsDetailsDelete");
    }
}
