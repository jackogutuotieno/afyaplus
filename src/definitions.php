<?php

namespace PHPMaker2024\afyaplus;

use Slim\Views\PhpRenderer;
use Slim\Csrf\Guard;
use Slim\HttpCache\CacheProvider;
use Slim\Flash\Messages;
use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Doctrine\DBAL\Logging\LoggerChain;
use Doctrine\DBAL\Logging\DebugStack;
use Doctrine\DBAL\Platforms;
use Doctrine\Common\Cache\Psr6\DoctrineProvider;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\Events;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Mime\MimeTypes;
use FastRoute\RouteParser\Std;
use Illuminate\Encryption\Encrypter;
use HTMLPurifier_Config;
use HTMLPurifier;

// Connections and entity managers
$definitions = [];
$dbids = array_keys(Config("Databases"));
foreach ($dbids as $dbid) {
    $definitions["connection." . $dbid] = \DI\factory(function (string $dbid) {
        return ConnectDb(Db($dbid));
    })->parameter("dbid", $dbid);
    $definitions["entitymanager." . $dbid] = \DI\factory(function (ContainerInterface $c, string $dbid) {
        $cache = IsDevelopment()
            ? DoctrineProvider::wrap(new ArrayAdapter())
            : DoctrineProvider::wrap(new FilesystemAdapter(directory: Config("DOCTRINE.CACHE_DIR")));
        $config = Setup::createAttributeMetadataConfiguration(
            Config("DOCTRINE.METADATA_DIRS"),
            IsDevelopment(),
            null,
            $cache
        );
        $conn = $c->get("connection." . $dbid);
        return new EntityManager($conn, $config);
    })->parameter("dbid", $dbid);
}

return [
    "app.cache" => \DI\create(CacheProvider::class),
    "app.flash" => fn(ContainerInterface $c) => new Messages(),
    "app.view" => fn(ContainerInterface $c) => new PhpRenderer($GLOBALS["RELATIVE_PATH"] . "views/"),
    "email.view" => fn(ContainerInterface $c) => new PhpRenderer($GLOBALS["RELATIVE_PATH"] . "lang/"),
    "sms.view" => fn(ContainerInterface $c) => new PhpRenderer($GLOBALS["RELATIVE_PATH"] . "lang/"),
    "app.audit" => fn(ContainerInterface $c) => (new Logger("audit"))->pushHandler(new AuditTrailHandler($GLOBALS["RELATIVE_PATH"] . "log/audit.log")), // For audit trail
    "app.logger" => fn(ContainerInterface $c) => (new Logger("log"))->pushHandler(new RotatingFileHandler($GLOBALS["RELATIVE_PATH"] . "log/log.log")),
    "sql.logger" => function (ContainerInterface $c) {
        $loggers = [];
        if (Config("DEBUG")) {
            $loggers[] = $c->get("debug.stack");
        }
        return (count($loggers) > 0) ? new LoggerChain($loggers) : null;
    },
    "app.csrf" => fn(ContainerInterface $c) => new Guard($GLOBALS["ResponseFactory"], Config("CSRF_PREFIX")),
    "html.purifier.config" => fn(ContainerInterface $c) => HTMLPurifier_Config::createDefault(),
    "html.purifier" => fn(ContainerInterface $c) => new HTMLPurifier($c->get("html.purifier.config")),
    "debug.stack" => \DI\create(DebugStack::class),
    "debug.sql.logger" => \DI\create(DebugSqlLogger::class),
    "debug.timer" => \DI\create(Timer::class),
    "app.security" => \DI\create(AdvancedSecurity::class),
    "user.profile" => \DI\create(UserProfile::class),
    "app.session" => \DI\create(HttpSession::class),
    "mime.types" => \DI\create(MimeTypes::class),
    "app.language" => \DI\create(Language::class),
    PermissionMiddleware::class => \DI\create(PermissionMiddleware::class),
    ApiPermissionMiddleware::class => \DI\create(ApiPermissionMiddleware::class),
    JwtMiddleware::class => \DI\create(JwtMiddleware::class),
    Std::class => \DI\create(Std::class),
    Encrypter::class => fn(ContainerInterface $c) => new Encrypter(AesEncryptionKey(base64_decode(Config("AES_ENCRYPTION_KEY"))), Config("AES_ENCRYPTION_CIPHER")),

    // Tables
    "appointments_report2" => \DI\create(AppointmentsReport2::class),
    "departments" => \DI\create(Departments::class),
    "designations" => \DI\create(Designations::class),
    "diagnosis" => \DI\create(Diagnosis::class),
    "diseases" => \DI\create(Diseases::class),
    "doctor_charges" => \DI\create(DoctorCharges::class),
    "doctor_notes" => \DI\create(DoctorNotes::class),
    "expenses" => \DI\create(Expenses::class),
    "invoice_details" => \DI\create(InvoiceDetails::class),
    "invoice_reports" => \DI\create(InvoiceReports::class),
    "invoices" => \DI\create(Invoices::class),
    "lab_test_reports" => \DI\create(LabTestReports::class),
    "lab_test_requests" => \DI\create(LabTestRequests::class),
    "lab_test_requests_details" => \DI\create(LabTestRequestsDetails::class),
    "medical_schemes" => \DI\create(MedicalSchemes::class),
    "medicine_brands" => \DI\create(MedicineBrands::class),
    "medicine_categories" => \DI\create(MedicineCategories::class),
    "medicine_dispensation" => \DI\create(MedicineDispensation::class),
    "medicine_stock" => \DI\create(MedicineStock::class),
    "medicine_stock_report2" => \DI\create(MedicineStockReport2::class),
    "medicine_suppliers" => \DI\create(MedicineSuppliers::class),
    "patient_appointments" => \DI\create(PatientAppointments::class),
    "patient_vaccinations" => \DI\create(PatientVaccinations::class),
    "patient_visits" => \DI\create(PatientVisits::class),
    "patient_vitals" => \DI\create(PatientVitals::class),
    "patients" => \DI\create(Patients::class),
    "payment_methods" => \DI\create(PaymentMethods::class),
    "prescription_details" => \DI\create(PrescriptionDetails::class),
    "prescriptions" => \DI\create(Prescriptions::class),
    "radiology_reports" => \DI\create(RadiologyReports::class),
    "radiology_requests" => \DI\create(RadiologyRequests::class),
    "radiology_requests_details" => \DI\create(RadiologyRequestsDetails::class),
    "service_categories" => \DI\create(ServiceCategories::class),
    "service_charges" => \DI\create(ServiceCharges::class),
    "service_subcategories" => \DI\create(ServiceSubcategories::class),
    "users" => \DI\create(Users::class),
    "vaccinationsreport2" => \DI\create(Vaccinationsreport2::class),
    "visit_types" => \DI\create(VisitTypes::class),
    "vitalsreport" => \DI\create(Vitalsreport::class),
    "exportlog" => \DI\create(Exportlog::class),
    "subscriptions" => \DI\create(Subscriptions::class),
    "Appointments" => \DI\create(Appointments::class),
    "appointments" => \DI\create(Appointments::class),
    "patient_queue" => \DI\create(PatientQueue::class),
    "laboratory_minor_report" => \DI\create(LaboratoryMinorReport::class),
    "laboratory_billing_report" => \DI\create(LaboratoryBillingReport::class),
    "laboratory_billing_report_details" => \DI\create(LaboratoryBillingReportDetails::class),
    "radiology_billing_report" => \DI\create(RadiologyBillingReport::class),
    "radiology_billing_report_details" => \DI\create(RadiologyBillingReportDetails::class),
    "pharmacy_billing_report" => \DI\create(PharmacyBillingReport::class),
    "income" => \DI\create(Income::class),
    "Appointments_Report" => \DI\create(AppointmentsReport::class),
    "appointments_report" => \DI\create(AppointmentsReport::class),
    "registered_patients_report" => \DI\create(RegisteredPatientsReport::class),
    "Registered_Patients" => \DI\create(RegisteredPatients::class),
    "registered_patients" => \DI\create(RegisteredPatients::class),
    "Medicine_Stock_Report" => \DI\create(MedicineStockReport::class),
    "medicine_stock_report" => \DI\create(MedicineStockReport::class),
    "patients_data_view" => \DI\create(PatientsDataView::class),
    "vaccinations_report3" => \DI\create(VaccinationsReport3::class),
    "Vaccinations_Report" => \DI\create(VaccinationsReport::class),
    "vaccinations_report" => \DI\create(VaccinationsReport::class),
    "visits_report" => \DI\create(VisitsReport::class),
    "Visits_Report1" => \DI\create(VisitsReport1::class),
    "visits_report1" => \DI\create(VisitsReport1::class),
    "income_report2" => \DI\create(IncomeReport2::class),
    "Income_Report" => \DI\create(IncomeReport::class),
    "income_report" => \DI\create(IncomeReport::class),
    "expenses_report2" => \DI\create(ExpensesReport2::class),
    "Expenses_Report" => \DI\create(ExpensesReport::class),
    "expenses_report" => \DI\create(ExpensesReport::class),
    "Facility_Overview" => \DI\create(FacilityOverview::class),
    "facility_overview" => \DI\create(FacilityOverview::class),
    "Front_Office_Overview" => \DI\create(FrontOfficeOverview::class),
    "front_office_overview" => \DI\create(FrontOfficeOverview::class),
    "Triage_Overview" => \DI\create(TriageOverview::class),
    "triage_overview" => \DI\create(TriageOverview::class),
    "Doctor_Overview" => \DI\create(DoctorOverview::class),
    "doctor_overview" => \DI\create(DoctorOverview::class),
    "Laboratory_Overview" => \DI\create(LaboratoryOverview::class),
    "laboratory_overview" => \DI\create(LaboratoryOverview::class),
    "Pharmacy_Overview" => \DI\create(PharmacyOverview::class),
    "pharmacy_overview" => \DI\create(PharmacyOverview::class),
    "Financials_Overview" => \DI\create(FinancialsOverview::class),
    "financials_overview" => \DI\create(FinancialsOverview::class),
    "radiology_report2" => \DI\create(RadiologyReport2::class),
    "Radiology_Report" => \DI\create(RadiologyReport::class),
    "radiology_report" => \DI\create(RadiologyReport::class),
    "Radiology_Overview" => \DI\create(RadiologyOverview::class),
    "radiology_overview" => \DI\create(RadiologyOverview::class),
    "medicine_dispensation_details" => \DI\create(MedicineDispensationDetails::class),
    "medicine_stock_data" => \DI\create(MedicineStockData::class),
    "pharmacy_billing_report_details" => \DI\create(PharmacyBillingReportDetails::class),
    "cash_payments" => \DI\create(CashPayments::class),
    "cash_payments_report" => \DI\create(CashPaymentsReport::class),
    "patients_lab_report" => \DI\create(PatientsLabReport::class),
    "patients_radiology_reports" => \DI\create(PatientsRadiologyReports::class),
    "patients_radiology_reports_details" => \DI\create(PatientsRadiologyReportsDetails::class),
    "laboratory_reports2" => \DI\create(LaboratoryReports2::class),
    "Laboratory_Reports" => \DI\create(LaboratoryReports::class),
    "laboratory_reports" => \DI\create(LaboratoryReports::class),
    "patients_dependants" => \DI\create(PatientsDependants::class),
    "branding" => \DI\create(Branding::class),
    "invoice_report" => \DI\create(InvoiceReport::class),
    "invoice_report_details" => \DI\create(InvoiceReportDetails::class),
    "ipd_patients" => \DI\create(IpdPatients::class),
    "modules" => \DI\create(Modules::class),
    "holidays" => \DI\create(Holidays::class),
    "leave_categories" => \DI\create(LeaveCategories::class),
    "leave_applications" => \DI\create(LeaveApplications::class),
    "leave_balance" => \DI\create(LeaveBalance::class),
    "leave_approvals" => \DI\create(LeaveApprovals::class),
    "beds" => \DI\create(Beds::class),
    "floors" => \DI\create(Floors::class),
    "ward_type" => \DI\create(WardType::class),
    "wards" => \DI\create(Wards::class),
    "patient_admissions" => \DI\create(PatientAdmissions::class),
    "bed_assignment" => \DI\create(BedAssignment::class),
    "suppliers" => \DI\create(Suppliers::class),
    "item_categories" => \DI\create(ItemCategories::class),
    "item_subcategories" => \DI\create(ItemSubcategories::class),
    "item_purchases" => \DI\create(ItemPurchases::class),
    "receive_items" => \DI\create(ReceiveItems::class),
    "issue_items" => \DI\create(IssueItems::class),
    "patients_discharge" => \DI\create(PatientsDischarge::class),
    "employees_view" => \DI\create(EmployeesView::class),
    "Employees_Report" => \DI\create(EmployeesReport::class),
    "employees_report" => \DI\create(EmployeesReport::class),
    "Human_Resources_Overview" => \DI\create(HumanResourcesOverview::class),
    "human_resources_overview" => \DI\create(HumanResourcesOverview::class),
    "received_items_view" => \DI\create(ReceivedItemsView::class),
    "patient_ipd_vitals" => \DI\create(PatientIpdVitals::class),
    "patient_ipd_services" => \DI\create(PatientIpdServices::class),
    "procurement_report2" => \DI\create(ProcurementReport2::class),
    "Procurement_Report" => \DI\create(ProcurementReport::class),
    "procurement_report" => \DI\create(ProcurementReport::class),
    "Procurement_Overview" => \DI\create(ProcurementOverview::class),
    "procurement_overview" => \DI\create(ProcurementOverview::class),
    "discharge_summary_report" => \DI\create(DischargeSummaryReport::class),
    "patient_ipd_prescription_details" => \DI\create(PatientIpdPrescriptionDetails::class),
    "patient_ipd_prescriptions" => \DI\create(PatientIpdPrescriptions::class),
    "ipd_billing_report" => \DI\create(IpdBillingReport::class),
    "ipd_bill_issued_items" => \DI\create(IpdBillIssuedItems::class),
    "ipd_bill_services" => \DI\create(IpdBillServices::class),
    "medicine_ipd_dispensation" => \DI\create(MedicineIpdDispensation::class),
    "medicine_ipd_dispensation_details" => \DI\create(MedicineIpdDispensationDetails::class),
    "ipd_bill_medicines" => \DI\create(IpdBillMedicines::class),
    "ipd_total_bill" => \DI\create(IpdTotalBill::class),
    "opd_bill_master_report" => \DI\create(OpdBillMasterReport::class),
    "opd_lab_master_bill" => \DI\create(OpdLabMasterBill::class),
    "opd_radiology_master_bill" => \DI\create(OpdRadiologyMasterBill::class),
    "opd_pharmacy_master_bill" => \DI\create(OpdPharmacyMasterBill::class),
    "opd_bill_total" => \DI\create(OpdBillTotal::class),
    "opd_consultation" => \DI\create(OpdConsultation::class),
    "ipd_bed_charges" => \DI\create(IpdBedCharges::class),
    "ipd_total_bed_charges" => \DI\create(IpdTotalBedCharges::class),
    "beds_status" => \DI\create(BedsStatus::class),
    "county" => \DI\create(County::class),
    "sub_county" => \DI\create(SubCounty::class),
    "moh704a_report" => \DI\create(Moh704aReport::class),
    "moh704b_report" => \DI\create(Moh704bReport::class),

    // User table
    "usertable" => \DI\get("users"),
] + $definitions;
