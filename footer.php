<footer class="footer" style = "left: 25px; right: 25px; background: #f1b44c;" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                2024 © Copyright.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-right d-none d-sm-block">
                    Support Email:<a href="#" target="_blank" class="text-muted"> new_ms_chat@gmail.com </a>
                </div>
            </div>
        </div>
    </div>
</footer>
				
<!-- end main content-->

<script>
$(document).ready(function() {
    // Function to add highlight class
    function highlightElement(element) {
        $(element).addClass('highlight');
    }

    // Function to remove highlight class
    function removeHighlight(element) {
        $(element).removeClass('highlight');
    }

    // Highlight input fields on focus
    $('input').focus(function() {
        highlightElement(this);
    }).blur(function() {
        removeHighlight(this);
    });

    // Highlight dropdowns on focus
    $('select').focus(function() {
        highlightElement(this);
    }).blur(function() {
        removeHighlight(this);
    });

});
</script>
   <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
		<script type="text/javascript" src="./assets/js/jquery.validate.js"></script>
		<script type="text/javascript" src="./assets/js/validation.js"></script>
		<!-- Include SweetAlert -->
        <script type="text/javascript" src="./assets/js/sweetalert.js"></script>
		
		<!-- Required datatable js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/jszip/jszip.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/js/pages/datatables.init.js"></script>    
		
		
        <script src="assets/js/app.js"></script>

    </body>
</html>