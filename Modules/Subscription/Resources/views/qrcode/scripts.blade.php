<script>
    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 10,
            qrbox: 250
        });

    function onScanSuccess(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        scanAction(decodedText, decodedResult);
        console.log(`Scan result: ${decodedText}`, decodedResult);
        // ...
        //html5QrcodeScanner.clear();
        // ^ this will stop the scanner (video feed) and clear the scan area.
    }

    function onScanError(errorMessage) {
        //return toastr.error(errorMessage);
    }

    html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>
