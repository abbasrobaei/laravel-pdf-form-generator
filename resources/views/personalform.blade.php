<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 60%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
.convas {
  border: 1px solid #040404 !important;
  border-radius: 4px;
  margin-top: 10px;
  background-color: #fff;
  max-width: 100%;

}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<body>

<h2>Personal Data</h2>
<p>Please fill out this form, sign it, and send it back to us.</p>

<div class="container">
    <form method="POST" action="{{ route('saveAsPdf') }}">
        @csrf
        <div class="row">
            <div class="col-25">
                <label for="firstname">First Name</label>
            </div>
            <div class="col-75">
                <input type="text" name="firstname" id="firstname" placeholder="First Name" required >
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="lastname">Last Name:</label>
            </div>
            <div class="col-75">
                <input type="text" name="lastname" id="lastname" placeholder="Last Name" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="birthdate">Birthdate:</label>
            </div>
            <div class="col-75">
                <input type="date" name="birthdate" id="birthdate" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="address">Address:</label>
            </div>
            <div class="col-75">
                <input type="text" name="address" id="address" placeholder="Address" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="social_security_number">Social Security Number:</label>
            </div>
            <div class="col-75">
                <input type="text" name="social_security_number" id="social_security_number" placeholder="Social Security Number" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="identification_number">Identification Number:</label>
            </div>
            <div class="col-75">
                <input type="text" name="identification_number" id="identification_number" placeholder="Identification Number" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="tax_class">Tax Class:</label>
            </div>
            <div class="col-75">
                <input type="text" name="tax_class" id="tax_class" placeholder="Tax Class" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="bank_account">Bank Account:</label>
            </div>
            <div class="col-75">
                <input type="text" name="bank_account" id="bank_account" placeholder="Bank Account" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="health_insurance">Health Insurance:</label>
            </div>
            <div class="col-75">
                <input type="text" name="health_insurance" id="health_insurance" placeholder="Health Insurance" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="nationality">Nationality:</label>
            </div>
            <div class="col-75">
                <input type="text" name="nationality" id="nationality" placeholder="Nationality" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="signature">Signature:</label>
            </div>
            <div class="col-75">
                <canvas class="convas" id="signatureCanvas"></canvas>
                <input type="hidden" name="signature" id="signature">
                <button type="button" style="margin-bottom: 40px;" onclick="clearSignature()">Clear Signature</button>
            </div>
        </div>
        <div class="row">
            <input type="submit" value="Save As PDF">
        </div>
    </form>
</div>
<script src="https://unpkg.com/signature_pad"></script>
<script>
    var canvas = document.getElementById('signatureCanvas');
    var signaturePad = new SignaturePad(canvas);

    // Function to save the signature when the form is submitted
    function saveSignature() {
        document.getElementById('signature').value = signaturePad.isEmpty() ? '' : signaturePad.toDataURL();
    }

    // Attach saveSignature function to form submission
    document.querySelector('form').addEventListener('submit', saveSignature);
</script>
<script>
    function clearSignature() {
        var canvas = document.getElementById('signatureCanvas');
        var signaturePad = new SignaturePad(canvas);
        signaturePad.clear();
    }
</script>

</body>
</html>
