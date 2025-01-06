<?php

namespace PHPMaker2024\afyaplus;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\afyaplus\Attributes\Delete;
use PHPMaker2024\afyaplus\Attributes\Get;
use PHPMaker2024\afyaplus\Attributes\Map;
use PHPMaker2024\afyaplus\Attributes\Options;
use PHPMaker2024\afyaplus\Attributes\Patch;
use PHPMaker2024\afyaplus\Attributes\Post;
use PHPMaker2024\afyaplus\Attributes\Put;

/**
 * Employees_Report controller
 */
class EmployeesReportController extends ControllerBase
{
    // summary
    #[Map(["GET", "POST", "OPTIONS"], "/employeesreport", [PermissionMiddleware::class], "summary.Employees_Report")]
    public function summary(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EmployeesReportSummary");
    }

    // EmployeesByGender (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/employeesreport/EmployeesByGender", [PermissionMiddleware::class], "summary.Employees_Report.EmployeesByGender")]
    public function EmployeesByGender(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "EmployeesReportSummary", "EmployeesByGender");
    }

    // EmployeesbyDepartment (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/employeesreport/EmployeesbyDepartment", [PermissionMiddleware::class], "summary.Employees_Report.EmployeesbyDepartment")]
    public function EmployeesbyDepartment(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "EmployeesReportSummary", "EmployeesbyDepartment");
    }

    // EmployeesbyDesignation (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/employeesreport/EmployeesbyDesignation", [PermissionMiddleware::class], "summary.Employees_Report.EmployeesbyDesignation")]
    public function EmployeesbyDesignation(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "EmployeesReportSummary", "EmployeesbyDesignation");
    }
}
