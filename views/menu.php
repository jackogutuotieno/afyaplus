<?php

namespace PHPMaker2024\afyaplus;

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(105, "mi_exportlog", $Language->menuPhrase("105", "MenuText"), "exportloglist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(49, "mci_Human_Resources", $Language->menuPhrase("49", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(2, "mi_departments", $Language->menuPhrase("2", "MenuText"), "departmentslist", 49, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(3, "mi_designations", $Language->menuPhrase("3", "MenuText"), "designationslist", 49, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(50, "mci_Doctor_Panel", $Language->menuPhrase("50", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(5, "mi_diseases", $Language->menuPhrase("5", "MenuText"), "diseaseslist", 50, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(6, "mi_doctor_charges", $Language->menuPhrase("6", "MenuText"), "doctorchargeslist", 50, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(51, "mci_Patients_Management", $Language->menuPhrase("51", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(48, "mi_patients", $Language->menuPhrase("48", "MenuText"), "patientslist", 51, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(22, "mi_patient_appointments", $Language->menuPhrase("22", "MenuText"), "patientappointmentslist", 51, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(24, "mi_patient_visits", $Language->menuPhrase("24", "MenuText"), "patientvisitslist", 51, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(25, "mi_patient_vitals", $Language->menuPhrase("25", "MenuText"), "patientvitalslist", 51, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(23, "mi_patient_vaccinations", $Language->menuPhrase("23", "MenuText"), "patientvaccinationslist", 51, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(4, "mi_diagnosis", $Language->menuPhrase("4", "MenuText"), "diagnosislist", 51, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(7, "mi_doctor_notes", $Language->menuPhrase("7", "MenuText"), "doctornoteslist", 51, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(28, "mi_prescriptions", $Language->menuPhrase("28", "MenuText"), "prescriptionslist", 51, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(52, "mci_Laboratory_Setup", $Language->menuPhrase("52", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(11, "mi_lab_specimens", $Language->menuPhrase("11", "MenuText"), "labspecimenslist", 52, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(13, "mi_lab_test_requests", $Language->menuPhrase("13", "MenuText"), "labtestrequestslist", 52, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(15, "mi_lab_test_requests_queue", $Language->menuPhrase("15", "MenuText"), "labtestrequestsqueuelist", 52, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(12, "mi_lab_test_reports", $Language->menuPhrase("12", "MenuText"), "labtestreportslist", 52, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(54, "mci_Pharmacy_Setup", $Language->menuPhrase("54", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(21, "mi_medicine_suppliers", $Language->menuPhrase("21", "MenuText"), "medicinesupplierslist", 54, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(17, "mi_medicine_brands", $Language->menuPhrase("17", "MenuText"), "medicinebrandslist", 54, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(47, "mi_medicine_stock", $Language->menuPhrase("47", "MenuText"), "medicinestocklist", 54, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(18, "mi_medicine_categories", $Language->menuPhrase("18", "MenuText"), "medicinecategorieslist", 54, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(19, "mi_medicine_dispensation", $Language->menuPhrase("19", "MenuText"), "medicinedispensationlist", 54, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(102, "mci_Radiology_Setup", $Language->menuPhrase("102", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(30, "mi_radiology_requests", $Language->menuPhrase("30", "MenuText"), "radiologyrequestslist", 102, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(32, "mi_radiology_requests_queue", $Language->menuPhrase("32", "MenuText"), "radiologyrequestsqueuelist", 102, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(29, "mi_radiology_reports", $Language->menuPhrase("29", "MenuText"), "radiologyreportslist", 102, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(53, "mci_Financials_Setup", $Language->menuPhrase("53", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(26, "mi_payment_methods", $Language->menuPhrase("26", "MenuText"), "paymentmethodslist", 53, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(10, "mi_invoices", $Language->menuPhrase("10", "MenuText"), "invoiceslist", 53, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(8, "mi_expenses", $Language->menuPhrase("8", "MenuText"), "expenseslist", 53, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(16, "mi_medical_schemes", $Language->menuPhrase("16", "MenuText"), "medicalschemeslist", 53, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(34, "mi_service_categories", $Language->menuPhrase("34", "MenuText"), "servicecategorieslist", 53, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(36, "mi_service_subcategories", $Language->menuPhrase("36", "MenuText"), "servicesubcategorieslist", 53, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(35, "mi_service_charges", $Language->menuPhrase("35", "MenuText"), "servicechargeslist", 53, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(104, "mci_Reports", $Language->menuPhrase("104", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(43, "mi_patients_report", $Language->menuPhrase("43", "MenuText"), "patientsreportlist", 104, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(39, "mi_appointments_report", $Language->menuPhrase("39", "MenuText"), "appointmentsreportlist", 104, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(44, "mi_patientsvisitsreport", $Language->menuPhrase("44", "MenuText"), "patientsvisitsreportlist", 104, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(40, "mi_invoice_reports", $Language->menuPhrase("40", "MenuText"), "invoicereportslist", 104, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(42, "mi_medicine_stock_report", $Language->menuPhrase("42", "MenuText"), "medicinestockreportlist", 104, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(45, "mi_vaccinationsreport", $Language->menuPhrase("45", "MenuText"), "vaccinationsreportlist", 104, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(46, "mi_vitalsreport", $Language->menuPhrase("46", "MenuText"), "vitalsreportlist", 104, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(41, "mi_laboratory_billing", $Language->menuPhrase("41", "MenuText"), "laboratorybillinglist", 104, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(103, "mci_Administrator", $Language->menuPhrase("103", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(33, "mi_roles", $Language->menuPhrase("33", "MenuText"), "roleslist", 103, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(37, "mi_users", $Language->menuPhrase("37", "MenuText"), "userslist", 103, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(38, "mi_visit_types", $Language->menuPhrase("38", "MenuText"), "visittypeslist", 103, "", true, false, false, "", "", false, true);
echo $sideMenu->toScript();
