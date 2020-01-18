<?php 
if ($expediente->mime == 'application/pdf'){
?>
    <embed id="pdfModalVistaDocumento" src="<?= asset("uploads/expediente/" . $expediente->solicitud_id . '/' . $expediente->archivo); ?>" type="application/pdf" width="100%" height="600px" />
<?php 
}else{
?>
    <img src="<?= asset("uploads/expediente/" . $expediente->solicitud_id . '/' . $expediente->archivo); ?>">
<?php
}
?>