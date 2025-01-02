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

class LeaveApplicationsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/leaveapplicationslist[/{id}]", [PermissionMiddleware::class], "list.leave_applications")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LeaveApplicationsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/leaveapplicationsadd[/{id}]", [PermissionMiddleware::class], "add.leave_applications")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LeaveApplicationsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/leaveapplicationsview[/{id}]", [PermissionMiddleware::class], "view.leave_applications")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LeaveApplicationsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/leaveapplicationsedit[/{id}]", [PermissionMiddleware::class], "edit.leave_applications")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LeaveApplicationsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/leaveapplicationsdelete[/{id}]", [PermissionMiddleware::class], "delete.leave_applications")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LeaveApplicationsDelete");
    }
}
