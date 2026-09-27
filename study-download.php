<?php
require_once 'config.php';

$studyId = $_GET['id'] ?? '';
if (!preg_match('/\A[a-f0-9]{24}\z/', $studyId)) {
    http_response_code(404);
    exit;
}

$study = null;
foreach (getStudies(true) as $candidate) {
    if (($candidate['id'] ?? '') === $studyId && !empty($candidate['pdf'])) {
        $study = $candidate;
        break;
    }
}

$pdfPath = STUDY_FILES_DIR . $studyId . '.pdf';
if ($study === null || !is_file($pdfPath) || !is_readable($pdfPath)) {
    http_response_code(404);
    exit;
}

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="Studieninformation.pdf"');
header('Content-Length: ' . filesize($pdfPath));
header('X-Content-Type-Options: nosniff');
readfile($pdfPath);