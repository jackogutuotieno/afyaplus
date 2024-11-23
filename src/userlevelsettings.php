<?php
/**
 * PHPMaker 2024 User Level Settings
 */
namespace PHPMaker2024\afyaplus;

/**
 * User levels
 *
 * @var array<int, string>
 * [0] int User level ID
 * [1] string User level name
 */
$USER_LEVELS = [["-2","Anonymous"]];

/**
 * User level permissions
 *
 * @var array<string, int, int>
 * [0] string Project ID + Table name
 * [1] int User level ID
 * [2] int Permissions
 */
$USER_LEVEL_PRIVS = [["{32536B8D-F37B-4419-80D5-260932800712}appointments_report","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}departments","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}designations","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}diagnosis","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}diseases","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}doctor_charges","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}doctor_notes","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}expenses","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}invoice_details","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}invoice_reports","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}invoices","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}lab_specimens","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}lab_test_reports","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}lab_test_requests","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}lab_test_requests_details","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}lab_test_requests_queue","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}laboratory_billing","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}medical_schemes","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}medicine_brands","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}medicine_categories","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}medicine_dispensation","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}medicine_dispensation_details","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}medicine_stock","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}medicine_stock_report","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}medicine_suppliers","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}patient_appointments","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}patient_vaccinations","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}patient_visits","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}patient_vitals","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}patients","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}patients_report","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}patientsvisitsreport","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}payment_methods","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}prescription_details","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}prescriptions","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}radiology_reports","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}radiology_requests","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}radiology_requests_details","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}radiology_requests_queue","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}roles","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}service_categories","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}service_charges","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}service_subcategories","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}users","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}vaccinationsreport","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}visit_types","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}vitalsreport","-2","0"],
    ["{32536B8D-F37B-4419-80D5-260932800712}exportlog","-2","0"]];

/**
 * Tables
 *
 * @var array<string, string, string, bool, string>
 * [0] string Table name
 * [1] string Table variable name
 * [2] string Table caption
 * [3] bool Allowed for update (for userpriv.php)
 * [4] string Project ID
 * [5] string URL (for OthersController::index)
 */
$USER_LEVEL_TABLES = [["appointments_report","appointments_report","appointments report",true,"{32536B8D-F37B-4419-80D5-260932800712}","appointmentsreportlist"],
    ["departments","departments","Departments",true,"{32536B8D-F37B-4419-80D5-260932800712}","departmentslist"],
    ["designations","designations","Designations",true,"{32536B8D-F37B-4419-80D5-260932800712}","designationslist"],
    ["diagnosis","diagnosis","diagnosis",true,"{32536B8D-F37B-4419-80D5-260932800712}","diagnosislist"],
    ["diseases","diseases","diseases",true,"{32536B8D-F37B-4419-80D5-260932800712}","diseaseslist"],
    ["doctor_charges","doctor_charges","doctor charges",true,"{32536B8D-F37B-4419-80D5-260932800712}","doctorchargeslist"],
    ["doctor_notes","doctor_notes","doctor notes",true,"{32536B8D-F37B-4419-80D5-260932800712}","doctornoteslist"],
    ["expenses","expenses","expenses",true,"{32536B8D-F37B-4419-80D5-260932800712}","expenseslist"],
    ["invoice_details","invoice_details","invoice details",true,"{32536B8D-F37B-4419-80D5-260932800712}","invoicedetailslist"],
    ["invoice_reports","invoice_reports","invoice reports",true,"{32536B8D-F37B-4419-80D5-260932800712}","invoicereportslist"],
    ["invoices","invoices","invoices",true,"{32536B8D-F37B-4419-80D5-260932800712}","invoiceslist"],
    ["lab_specimens","lab_specimens","lab specimens",true,"{32536B8D-F37B-4419-80D5-260932800712}","labspecimenslist"],
    ["lab_test_reports","lab_test_reports","lab test reports",true,"{32536B8D-F37B-4419-80D5-260932800712}","labtestreportslist"],
    ["lab_test_requests","lab_test_requests","lab test requests",true,"{32536B8D-F37B-4419-80D5-260932800712}","labtestrequestslist"],
    ["lab_test_requests_details","lab_test_requests_details","lab test requests details",true,"{32536B8D-F37B-4419-80D5-260932800712}","labtestrequestsdetailslist"],
    ["lab_test_requests_queue","lab_test_requests_queue","lab test requests queue",true,"{32536B8D-F37B-4419-80D5-260932800712}","labtestrequestsqueuelist"],
    ["laboratory_billing","laboratory_billing","laboratory billing",true,"{32536B8D-F37B-4419-80D5-260932800712}","laboratorybillinglist"],
    ["medical_schemes","medical_schemes","medical schemes",true,"{32536B8D-F37B-4419-80D5-260932800712}","medicalschemeslist"],
    ["medicine_brands","medicine_brands","medicine brands",true,"{32536B8D-F37B-4419-80D5-260932800712}","medicinebrandslist"],
    ["medicine_categories","medicine_categories","medicine categories",true,"{32536B8D-F37B-4419-80D5-260932800712}","medicinecategorieslist"],
    ["medicine_dispensation","medicine_dispensation","medicine dispensation",true,"{32536B8D-F37B-4419-80D5-260932800712}","medicinedispensationlist"],
    ["medicine_dispensation_details","medicine_dispensation_details","medicine dispensation details",true,"{32536B8D-F37B-4419-80D5-260932800712}","medicinedispensationdetailslist"],
    ["medicine_stock","medicine_stock","medicine stock",true,"{32536B8D-F37B-4419-80D5-260932800712}","medicinestocklist"],
    ["medicine_stock_report","medicine_stock_report","medicine stock report",true,"{32536B8D-F37B-4419-80D5-260932800712}","medicinestockreportlist"],
    ["medicine_suppliers","medicine_suppliers","medicine suppliers",true,"{32536B8D-F37B-4419-80D5-260932800712}","medicinesupplierslist"],
    ["patient_appointments","patient_appointments","patient appointments",true,"{32536B8D-F37B-4419-80D5-260932800712}","patientappointmentslist"],
    ["patient_vaccinations","patient_vaccinations","patient vaccinations",true,"{32536B8D-F37B-4419-80D5-260932800712}","patientvaccinationslist"],
    ["patient_visits","patient_visits","patient visits",true,"{32536B8D-F37B-4419-80D5-260932800712}","patientvisitslist"],
    ["patient_vitals","patient_vitals","patient vitals",true,"{32536B8D-F37B-4419-80D5-260932800712}","patientvitalslist"],
    ["patients","patients","Patients",true,"{32536B8D-F37B-4419-80D5-260932800712}","patientslist"],
    ["patients_report","patients_report","patients report",true,"{32536B8D-F37B-4419-80D5-260932800712}","patientsreportlist"],
    ["patientsvisitsreport","patientsvisitsreport","patientsvisitsreport",true,"{32536B8D-F37B-4419-80D5-260932800712}","patientsvisitsreportlist"],
    ["payment_methods","payment_methods","payment methods",true,"{32536B8D-F37B-4419-80D5-260932800712}","paymentmethodslist"],
    ["prescription_details","prescription_details","prescription details",true,"{32536B8D-F37B-4419-80D5-260932800712}","prescriptiondetailslist"],
    ["prescriptions","prescriptions","prescriptions",true,"{32536B8D-F37B-4419-80D5-260932800712}","prescriptionslist"],
    ["radiology_reports","radiology_reports","radiology reports",true,"{32536B8D-F37B-4419-80D5-260932800712}","radiologyreportslist"],
    ["radiology_requests","radiology_requests","radiology requests",true,"{32536B8D-F37B-4419-80D5-260932800712}","radiologyrequestslist"],
    ["radiology_requests_details","radiology_requests_details","radiology requests details",true,"{32536B8D-F37B-4419-80D5-260932800712}","radiologyrequestsdetailslist"],
    ["radiology_requests_queue","radiology_requests_queue","radiology requests queue",true,"{32536B8D-F37B-4419-80D5-260932800712}","radiologyrequestsqueuelist"],
    ["roles","roles","roles",true,"{32536B8D-F37B-4419-80D5-260932800712}","roleslist"],
    ["service_categories","service_categories","service categories",true,"{32536B8D-F37B-4419-80D5-260932800712}","servicecategorieslist"],
    ["service_charges","service_charges","service charges",true,"{32536B8D-F37B-4419-80D5-260932800712}","servicechargeslist"],
    ["service_subcategories","service_subcategories","service subcategories",true,"{32536B8D-F37B-4419-80D5-260932800712}","servicesubcategorieslist"],
    ["users","users","users",true,"{32536B8D-F37B-4419-80D5-260932800712}","userslist"],
    ["vaccinationsreport","vaccinationsreport","vaccinationsreport",true,"{32536B8D-F37B-4419-80D5-260932800712}","vaccinationsreportlist"],
    ["visit_types","visit_types","visit types",true,"{32536B8D-F37B-4419-80D5-260932800712}","visittypeslist"],
    ["vitalsreport","vitalsreport","vitalsreport",true,"{32536B8D-F37B-4419-80D5-260932800712}","vitalsreportlist"],
    ["exportlog","exportlog","exportlog",true,"{32536B8D-F37B-4419-80D5-260932800712}","exportloglist"]];
