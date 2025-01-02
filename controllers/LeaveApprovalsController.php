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

class LeaveApprovalsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/leaveapprovalslist[/{id}]", [PermissionMiddleware::class], "list.leave_approvals")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LeaveApprovalsList");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/leaveapprovalsedit[/{id}]", [PermissionMiddleware::class], "edit.leave_approvals")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LeaveApprovalsEdit");
    }
}
