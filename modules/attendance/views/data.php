<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
               <h4 class="no-margin font-bold">Attendance</h4>
            <hr />
            <table class="table table-striped" id="tabeluser">
                <thead>
                <tr>
                <th>Waktu Check In/Out</th>
                <th>Tipe</th>
                </tr>
                </thead>
                    <tbody>
                    <?php
                    foreach ($att as $u) {
                        $check = "";
                        if($u['checktype'] == "I"){
                            $check = "Check In";
                        }else{
                            $check = "Check Out";
                        }
                    echo "<tr>";
                    echo "<td>" . $u['checktime'] . "</td>";
                    echo "<td>" . $check . "</td>";
                    echo "</tr>";
                    }
                    ?>
                    </tbody>
            </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php init_tail(); ?>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {
      $('#tabeluser').DataTable({
        order: [[0, 'desc']],
    });
  });
  </script>
</html>