<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" integrity="sha384-feJI7QwhOS+hwpX2zkaeJQjeiwlhOP+SdQDqhgvvo1DsjtiSQByFdThsxO669S2D" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.0.0/dt-1.10.16/datatables.min.js">
</script>


<script>
$("#user_dir").DataTable({
}
);
</script>
<script>
$("#journal").DataTable({
}
);
</script>
<script>
$("#chart_of_accounts").DataTable({
  "columnDefs": [
    { "searchable": false, "targets": 7 }
  ]
} );
</script>
<script>
$("#accounts").DataTable({
  "columnDefs": [
    { "searchable": false, "targets": 8 }
  ]
} );
</script>
<script>
$( function() {
  $( "#datepicker" ).datepicker();
} );
</script>
<script>
$(function() {
  $("#dialog").dialog({
    autoOpen: false
  });
  $("#button").on("click", function() {
    $("#dialog").dialog("open");
  });
});
</script>


</body>

</html>
