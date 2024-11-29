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
    "appointments_report" => \DI\create(AppointmentsReport::class),
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
    "lab_specimens" => \DI\create(LabSpecimens::class),
    "lab_test_reports" => \DI\create(LabTestReports::class),
    "lab_test_requests" => \DI\create(LabTestRequests::class),
    "lab_test_requests_details" => \DI\create(LabTestRequestsDetails::class),
    "lab_test_requests_queue" => \DI\create(LabTestRequestsQueue::class),
    "medical_schemes" => \DI\create(MedicalSchemes::class),
    "medicine_brands" => \DI\create(MedicineBrands::class),
    "medicine_categories" => \DI\create(MedicineCategories::class),
    "medicine_dispensation" => \DI\create(MedicineDispensation::class),
    "medicine_dispensation_details" => \DI\create(MedicineDispensationDetails::class),
    "medicine_stock" => \DI\create(MedicineStock::class),
    "medicine_stock_report" => \DI\create(MedicineStockReport::class),
    "medicine_suppliers" => \DI\create(MedicineSuppliers::class),
    "patient_appointments" => \DI\create(PatientAppointments::class),
    "patient_vaccinations" => \DI\create(PatientVaccinations::class),
    "patient_visits" => \DI\create(PatientVisits::class),
    "patient_vitals" => \DI\create(PatientVitals::class),
    "patients" => \DI\create(Patients::class),
    "patients_report" => \DI\create(PatientsReport::class),
    "payment_methods" => \DI\create(PaymentMethods::class),
    "prescription_details" => \DI\create(PrescriptionDetails::class),
    "prescriptions" => \DI\create(Prescriptions::class),
    "radiology_reports" => \DI\create(RadiologyReports::class),
    "radiology_requests" => \DI\create(RadiologyRequests::class),
    "radiology_requests_details" => \DI\create(RadiologyRequestsDetails::class),
    "radiology_requests_queue" => \DI\create(RadiologyRequestsQueue::class),
    "service_categories" => \DI\create(ServiceCategories::class),
    "service_charges" => \DI\create(ServiceCharges::class),
    "service_subcategories" => \DI\create(ServiceSubcategories::class),
    "users" => \DI\create(Users::class),
    "vaccinationsreport" => \DI\create(Vaccinationsreport::class),
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
    "pharmacy_billing_report_details" => \DI\create(PharmacyBillingReportDetails::class),

    // User table
    "usertable" => \DI\get("users"),
] + $definitions;
