<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;

class PersonalDataController extends Controller
{
    public function saveAsPdf(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'birthdate' => 'required',
            'address' => 'required',
            'social_security_number' => 'required',
            'identification_number' => 'required',
            'tax_class' => 'required',
            'bank_account' => 'required',
            'health_insurance' => 'required',
            'nationality' => 'required',
            'signature' => 'required',
        ]);

        // Logic to save the form data as PDF
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->AddPage();
        $pdf->SetFontSize(20);
        $pdf->SetFont('helvetica', 'B', 20);
        $pdf->Cell(0, 30, 'Personal Data', 0, 1, 'C'); // Add the text at the center
        $pdf->SetFont('helvetica', '', 12);

        // Loop through form data and add to PDF
        foreach ($validatedData as $key => $value) {
            if ($key === 'signature') {
                continue; // Skip the signature field
            }
            $pdf->Cell(0, 14, ucfirst($key) . ': ' . $value, 0, 1);
        }

        $pdf->Cell(0, 14, 'Start: ' , 0, 1);
        $pdf->Cell(0, 14, 'Gross Salary: ' , 0, 1);
        // Add signature to PDF
        $signature = $request->input('signature');
        list($type, $signature) = explode(';', $signature);
        list(, $signature) = explode(',', $signature);
        $signatureData = base64_decode($signature);
        
        // Save the signature as a temporary file
        $signatureFile = tempnam(sys_get_temp_dir(), 'signature');
        file_put_contents($signatureFile, $signatureData);
        
        // Add the signature image to the PDF
        $pdf->Cell(0, 20, 'I hereby confirm the accuracy of the above data! ' , 0, 1);
        $pdf->Image($signatureFile, 60, $pdf->GetY() + 0, 40, 40, 'PNG');
        $pdf->Cell(0, 40, '' , 0, 1);
        // Draw line after signature
        $pdf->Cell(0, 5, 'Place, Date, Signature' , 0, 1);
        $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + $pdf->GetPageWidth() , $pdf->GetY());

        // Save the PDF file
        $fileName = 'PersonalData_' . $validatedData['firstname'] . '_' . $validatedData['lastname'] . '.pdf';
        $filePath = public_path('files/' . $fileName);
        $pdf->Output($filePath, 'F');

        // Remove the temporary signature file
        unlink($signatureFile);

        // Return the PDF file as a download response
        return response()->download($filePath, $fileName)->deleteFileAfterSend(true);
    }
}
