@component('mail::message')
    <h1>Email with QR Code</h1>
    <p>This email contains a QR code representing your email address.</p>
        <img src="https://borkyassociates.ng/task/public/qr_codes/{{$qrCodePath}}">
        <p>Scan the QR code to reveal your email address</p> 
@endcomponent