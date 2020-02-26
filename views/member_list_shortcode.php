<div class="container">
  <h2>Member List</h2>
  <div class="form-group" style="float: right">
  <!-- <label for="status">Select Style:</label> -->
  <select class="form-control" id="status" onchange="changeMemberStatus()">
    <option value="">-- Select Status --</option>
    <option value="1">Died</option>
    <option value="2">Retired</option>
    <option value="3">Active</option>
  </select>
</div>

  <table id="memberTable">
    <thead>
      <tr>
        <th>Sl</th>
        <th>Name</th>
        <th>Father Name</th>
        <th>Mobile</th>
        <th>Status</th>
      </tr>
    </thead>
  </table>
</div>


<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('../public/datatables/DataTables-1.10.20/css/dataTables.jqueryui.min.css', __FILE__); ?>">
<script src="<?php echo plugins_url('../public/datatables/datatables.min.js', __FILE__); ?>"></script>
<script src="<?php echo plugins_url('../public/js/member.js', __FILE__); ?>"></script>

<script type="text/javascript">
  var pluginUrl = "<?php echo plugins_url('/'); ?>";
  jQuery(function(){
    readMembers();

  })
</script>
