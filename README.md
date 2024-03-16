# Laravel PDF Form Generator with Personal Signature

This Laravel application allows you to generate PDF forms based on user input.

## Author Information
- **Name:** Abbas Robaei
- **Email:** abbas@robaei.de
- **Website:** [robaei.net](https://robaei.net)

## Repository
- **GitHub:** [abbasrobaei/laravel-pdf-form-generator](https://github.com/abbasrobaei/laravel-pdf-form-generator.git)

## Description
This Laravel application provides a simple form for users to fill out their personal information. Once the form is submitted, the data is validated and saved as a PDF file, including a signature. Users can then download the generated PDF file.

## Features
- Form validation
- Generating PDF with user-submitted data
- Adding signature to the PDF
- Downloading the generated PDF file

## Requirements
- PHP >= 7.3
- Laravel >= 8.0
- TCPDF library

## Installation
1. Clone the repository: `git clone https://github.com/abbasrobaei/laravel-pdf-form-generator.git`
2. Install dependencies: `composer install`
3. Configure your environment variables: `.env`
4. Migrate the database: `php artisan migrate`

## Usage
1. Run the Laravel development server: `php artisan serve`
2. Access the application in your web browser: `http://localhost:8000`
3. Fill out the form with your personal information.
4. Sign the form using the provided canvas.
5. Click the "Save As PDF" button to generate the PDF file.
6. Download the generated PDF file.

## License
This project is open-sourced software licensed under the [MIT license](LICENSE).

